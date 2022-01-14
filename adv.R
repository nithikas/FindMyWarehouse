#Initiating R-php connection
library(RMySQL)
args <- commandArgs(TRUE)


#Obtaining values from html form
zip_code <- args[1]
start_date <- args[2]
end_date <- args[3]
pr <- args[4]
sh <- args[5]
mob <- args[6]
mult <- args[7]
mez <- args[8]
lbp <- args[9]
hbp <- args[10]
lsb <- args[11]
hsb <- args[12]
ew <- args[13]
yb <- args[14]
lor <- args[15]
lwr <- args[16]
#Initiating R-MySQL connection
mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')

#Zip-code is a required field on the form, so we immediately select the warehouses is the user-specified zip code
query <- paste0("SELECT * FROM Warehouse W, Listing L WHERE W.Warehouse_ID = L.Warehouse_ID AND W.ZIP_Code = ", zip_code, " GROUP BY W.Warehouse_ID")
Filtered_Warehouses <- fetch(dbSendQuery(mydb, query))

#If one space bound is given and the other is not, we make the bound that was not specified the most extreme value it can be in our system to make calculations easier
if (lsb == "false" && hsb != "false"){
  lsb <- 0
}
if (hsb == "false" && lsb != "false"){
  hsb <- fetch(dbSendQuery(mydb,"SELECT max(Total_Space_Available_for_Rent) FROM Warehouse"))
}
#Get the contracts corresponding to the warehouses we have chosen
query <- paste("SELECT * FROM Contract WHERE Warehouse_ID IN (",paste(Filtered_Warehouses$Warehouse_ID,collapse=", "),")")
Contract <- fetch(dbSendQuery(mydb, query))

#If the user wants to specify a date range
if (start_date != "false" || end_date != "false"){
  #If only one of the dates is specified, make the other the same date to make calculations easier
  if (start_date == "false"){
    start_date <- end_date
  }
  else if (end_date == "false"){
    end_date <- start_date
  }
  
  #How many warehouses do we have in consideration
  warehouseLength <- length(Filtered_Warehouses[,1])
  i <- 1
  while (i <= warehouseLength){
    #If there is a contract/contracts that correspond to the warehouse i, store the indexes of those warehouses in the contracts table
    indexes <- which(is.na(which(Filtered_Warehouses$Warehouse_ID[i] %in% Contract$Warehouse_ID)) == FALSE)
    #If this case exists
    if (length(indexes) > 0){
      j = 1
      while (j <= length(indexes)){
        current <- indexes[j]
        #Go through each of the contracts corresponding to the warehouse in question and check if there is an overlap in start date and end date
        if(as.Date(start_date) <= Contract$End_Date_of_Lease[current] && as.Date(end_date) >= Contract$Start_Date_of_Lease[current]){
          #If there is no space left in the warehouse during the time requested, automatically remove the warehouse from the list
          if (Filtered_Warehouses$Total_Space_Available_for_Rent[i] - Contract$Space_Rented[current] == 0){
            Filtered_Warehouses <- Filtered_Warehouses[-(i),]
          }
          #If there is space left,
          else{
            #Store this value
            Space_Left <- Filtered_Warehouses$Total_Space_Available_for_Rent[i] - Contract$Space_Rented[current]
            #Replace the space value in the filtered warehouse table with the space left for later calculations
            Filtered_Warehouses$Total_Space_Available_for_Rent[i] <- Space_Left
            #If the user wants the entire warehouse and it is not available, remove the warehouse
            if (ew != "false" && Space_Left < Filtered_Warehouses$Total_Space_Available_for_Rent[i]){
              Filtered_Warehouses <- Filtered_Warehouses[-(i),]
            }
            #If the user does not want the entire warehouse
            if (lsb != "false" && hsb != "false" && ew == "false"){
              #If the space left is not within the bounds that the user specified, remove the warehouse
              if (lsb > Space_Left || hsb < Space_Left){
                Filtered_Warehouses <- Filtered_Warehouses[-(i),]
              }
            }
          }
        }
        j = j + 1
      }
    }
    i = i + 1
  }
}else{
  if (lsb != "false" && hsb != "false"){
    #If the space left is not within the bounds that the user specified, remove the warehouse
    warehouseLength <- length(Filtered_Warehouses[,1])
    i <- 1
    while (i <= warehouseLength){
      if (lsb > Filtered_Warehouses$Total_Space_Available_for_Rent[i] || hsb < Filtered_Warehouses$Total_Space_Available_for_Rent[i]){
        Filtered_Warehouses <- Filtered_Warehouses[-(i),]
      }
      i <- i + 1
    }
  }
}
intersect1 <- 0
#Logic behind intersect1: we use this variable in the case of a user wanting multiple storage types. For each storage type, if the previous storage types are also selected, then the program will find the common warehouses among all of the generated lists so that the warehouses in the final list have all of the types of storage specified by the user
#If the user wants pallet racking, select the warehouses that have pallet racking and that are in the filtered warehouse table
if (pr != "false"){
  query1 <- paste("SELECT W.Warehouse_ID FROM Type_Of_Storage T, Warehouse W WHERE W.Warehouse_ID = T.Warehouse_ID AND T.Type_Of_Storage = 'Pallet Racking' AND W.Warehouse_ID IN (",paste(Filtered_Warehouses$Warehouse_ID,collapse=", "),")")
  Filtered_Pal <- fetch(dbSendQuery(mydb,query1))
  intersect1 <- Filtered_Pal$Warehouse_ID
}
#If the user wants shelving, select the warehouses that have shelving and that are in the filtered warehouse table
if(sh != "false"){
  query2 <- paste("SELECT W.Warehouse_ID FROM Type_Of_Storage T, Warehouse W WHERE W.Warehouse_ID = T.Warehouse_ID AND T.Type_Of_Storage = 'Shelving' AND W.Warehouse_ID IN (",paste(Filtered_Warehouses$Warehouse_ID,collapse=", "),")")
  Filtered_Shel <- fetch(dbSendQuery(mydb,query2))
  if(intersect1 != 0){
    intersect1 <- intersect(intersect1,Filtered_Shel$Warehouse_ID)
  }
  else{
    intersect1 <- Filtered_Shel$Warehouse_ID
  }
}
#If the user wants mobile shelving, select the warehouses that have mobile shelving and that are in the filtered warehouse table
if(mob != "false"){
  query3 <- paste("SELECT W.Warehouse_ID FROM Type_Of_Storage T, Warehouse W WHERE W.Warehouse_ID = T.Warehouse_ID AND T.Type_Of_Storage = 'Mobile Shelving' AND W.Warehouse_ID IN (",paste(Filtered_Warehouses$Warehouse_ID,collapse=", "),")")
  Filtered_Mob <- fetch(dbSendQuery(mydb,query3))
  if(intersect1 != 0){
    intersect1 <- intersect(intersect1,Filtered_Mob$Warehouse_ID)
  }
  else{
    intersect1 <- Filtered_Mob$Warehouse_ID
  }
}
#If the user wants multi-tier racking, select the warehouses that have multi-tier racking and that are in the filtered warehouse table
if(mult != "false"){
  query4 <- paste("SELECT W.Warehouse_ID FROM Type_Of_Storage T, Warehouse W WHERE W.Warehouse_ID = T.Warehouse_ID AND T.Type_Of_Storage = 'Multi-tier Racking' AND W.Warehouse_ID IN (",paste(Filtered_Warehouses$Warehouse_ID,collapse=", "),")")
  Filtered_Mult <- fetch(dbSendQuery(mydb,query4))
  if(intersect1 != 0){
    intersect1 <- intersect(intersect1,Filtered_Mult$Warehouse_ID)
  }
  else{
    intersect1 <- Filtered_Mult$Warehouse_ID
  }
}
#If the user wants mezzanine flooring, select the warehouses that have mezzanine flooring and that are in the filtered warehouse table
if(mez != "false"){
  query5 <- paste("SELECT W.Warehouse_ID FROM Type_Of_Storage T, Warehouse W WHERE W.Warehouse_ID = T.Warehouse_ID AND T.Type_Of_Storage = 'Mezzanine Flooring' AND W.Warehouse_ID IN (",paste(Filtered_Warehouses$Warehouse_ID,collapse=", "),")")
  Filtered_Mezz <- fetch(dbSendQuery(mydb,query5))
  if(intersect1 != 0){
    intersect1 <- intersect(intersect1,Filtered_Mezz$Warehouse_ID)
  }
  else{
    intersect1 <- Filtered_Mezz$Warehouse_ID
  }
}
#Get all of the rest of the information from the database for the warehouses that match all of the criteria specified thus far
if (intersect1 != 0){
  query <- paste("SELECT * FROM Warehouse W, Listing L WHERE W.Warehouse_ID = L.Warehouse_ID AND W.Warehouse_ID IN (",paste(intersect1,collapse=", "),")")
  Filtered_Warehouses <- fetch(dbSendQuery(mydb,query))
}else{
  for (i in 1:length(Filtered_Warehouses)){
    Filtered_Warehouses[-(i),]
  }
}
#If one price bound is given and the other is not, we make the bound that was not specified the most extreme value it can be in our system to make calculations easier
if (args[9] == "false" && args[10] != "false"){
  lbp <- fetch(dbSendQuery(mydb,"SELECT min(Listed_Rental_Price) FROM Listing"))
}
if (args[10] == "false" && args[9] != "false"){
  hbp <- fetch(dbSendQuery(mydb,"SELECT max(Listed_Rental_Price) FROM Listing"))
}
#Select all of the warehouses that fall within the price bounds and that already exist in the filtered list
if (lbp != "false" && hbp != "false"){
  lbp <- as.numeric(lbp)
  hbp <- as.numeric(hbp)
  query <- paste0("SELECT * FROM Warehouse W, Listing L WHERE W.Warehouse_ID = L.Warehouse_ID AND W.Warehouse_ID IN (",paste(Filtered_Warehouses$Warehouse_ID,collapse=", "),") AND L.Listed_Rental_Price <= ", hbp, " AND L.Listed_Rental_Price >= ", lbp, " GROUP BY W.Warehouse_ID")
  Filtered_Warehouses <- fetch(dbSendQuery(mydb, query))
}
#Select all of the warehouses that are newer that the year the user specified and that already exist in the filtered list
if (yb != "false"){
  query <- paste0("SELECT * FROM Warehouse W, Listing L WHERE W.Warehouse_ID = L.Warehouse_ID AND W.Year_Built >= ", yb," AND W.Warehouse_ID IN (",paste(Filtered_Warehouses$Warehouse_ID,collapse=", "),")")
  Filtered_Warehouses <- fetch(dbSendQuery(mydb, query))
}

#Get the contracts corresponding to the warehouses we have boiled it down to
for (i in 1:length(Filtered_Warehouses[,1])){
  query <- paste("SELECT SUM(Average_Warehouse_Rating)/COUNT(Average_Warehouse_Rating) FROM Contract WHERE Warehouse_ID = ", Filtered_Warehouses$Warehouse_ID[i], "")
  data <- fetch(dbSendQuery(mydb, query))
  Filtered_Warehouses$Total_Average_Warehouse_Rating[i] <- data[,1]
  query <- paste("SELECT SUM(Average_Owner_Rating)/COUNT(Average_Owner_Rating) FROM Contract WHERE Warehouse_ID = ", Filtered_Warehouses$Warehouse_ID[i], "")
  data <- fetch(dbSendQuery(mydb, query))
  Filtered_Warehouses$Total_Average_Owner_Rating[i] <- data[,1]
}
#Select all of the warehouses that are rated above the user-specified lower bound for warehouse rating
if (lwr != "false"){
  for (i in 1:length(Filtered_Warehouses[,1])){
    if (lwr >= Filtered_Warehouses$Total_Average_Warehouse_Rating[i]){
      Filtered_Warehouses <- Filtered_Warehouses[-(i),]
    }
  }
}

#Select all of the warehouses that are rated above the user-specified lower bound for owner rating
if (lor != "false"){
  for (i in 1:length(Filtered_Warehouses[,1])){
    if (lor >= Filtered_Warehouses$Total_Average_Owner_Rating[i]){
      Filtered_Warehouses <- Filtered_Warehouses[-(i),]
    }
  }
}

Warehouse_Length <- length(Filtered_Warehouses[,1])
#If more than zero results fit the user-specifications, start sending php the warehouses
if(Warehouse_Length > 0){
  #If there is only one warehouse, we do not need to implement the ranking algorithm
  if (Warehouse_Length == 1){
    #make sure that the warehouses have ten digits (this is like the mysql zerofill)
    Filtered_Warehouses$Warehouse_ID <- sprintf("%010d", Filtered_Warehouses$Warehouse_ID)
    Filtered_Warehouses$Warehouse_ID
  }else{ #If there is more than one warehouse, implement the ranking algorithm
    ranking_values <- c()
    #Iterate through the warehouses, and assign them ranking values
    #If the user did not specify a value for the filter, set the ranking value to 0 so that it does not affect the ranking equation
    #If the user specified a value for the filter, apply the corresponding term in the ranking algorithm
    for (i in 1:Warehouse_Length){
      if (lbp != "false"){
        price_ranking <- 4 * abs(as.numeric(Filtered_Warehouses$Listed_Rental_Price[i]) - as.numeric(hbp))
      }else{
        price_ranking <- 0
      }
      if (lsb != "false"){
        space_ranking <- 3 * abs(as.numeric(Filtered_Warehouses$Total_Space_Available_for_Rent[i]) - as.numeric(lsb))
      }else{
        space_ranking <- 0
      }
      if (lor != "false"){
        owner_rating_ranking <- 2 * abs(as.numeric(Filtered_Warehouses$Total_Average_Owner_Rating[i]) - as.numeric(lor))
      }else{
        owner_rating_ranking <- 0
      }
      if (lwr != "false"){
        warehouse_rating_ranking <- 2 * abs(as.numeric(Filtered_Warehouses$Total_Average_Warehouse_Rating[i]) - as.numeric(lwr))
      }else{
        warehouse_rating_ranking <- 0
      }
      if (yb != "false"){
        year_built_ranking <- 1 * abs(as.numeric(Filtered_Warehouses$Year_Built[i]) - as.numeric(yb))
      }else{
        year_built_ranking <- 0
      }
      ranking_values[i] <- price_ranking + space_ranking + owner_rating_ranking + warehouse_rating_ranking + year_built_ranking
    }
    #Create a new column in for the ranking values
    Filtered_Warehouses$rankings <- ranking_values
    #Collect the order of the negative rankings (so that they will be in increasing order)
    index <- with(Filtered_Warehouses, order(-rankings))
    #Reorder the data frame so that the rows are in order of increasing rankings
    Filtered_Warehouses <- Filtered_Warehouses[index, ]
    #Zerofill the ids to match the database
    Filtered_Warehouses$Warehouse_ID <- sprintf("%010d", Filtered_Warehouses$Warehouse_ID)
    #Return the ids to php
    Filtered_Warehouses$Warehouse_ID
  }
}



