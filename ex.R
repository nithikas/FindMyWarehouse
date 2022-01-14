library(RMySQL)
#Initiate R-php connection
args <- commandArgs(TRUE)
zip_code <- args[1]
start_date <- args[2]
end_date <- args[3]


mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')

#Select all of the warehouses in the user-specific zip code
query <- paste0("SELECT * FROM Warehouse W, Listing L WHERE W.Warehouse_ID = L.Warehouse_ID AND W.ZIP_Code = ", zip_code, " GROUP BY W.Warehouse_ID")
Filtered_Warehouses <- fetch(dbSendQuery(mydb, query))

#If the user specifies a start date or end date
if (start_date != "false" || end_date != "false"){
   mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
   
   #Get the contracts corresponding to the filtered warehouses
   query <- paste("SELECT * FROM Contract WHERE Warehouse_ID IN (",paste(Filtered_Warehouses$Warehouse_ID,collapse=", "),")")
   Contract <- fetch(dbSendQuery(mydb, query))
  #If either of the dates is false, make the two dates the same
  if (start.date == "false"){
    start_date <- end_date
  }
  else if (end_date == "false"){
    end_date <- start_date
  }
  warehouseLength = length(Filtered_Warehouses[,1])
  i = 1
  while (i <= warehouseLength){
    #Get the indexes of the filtered warehouses that have a contract
    indexes <- which(is.na(which(Filtered_Warehouses$Warehouse_ID[i] %in% Contract$Warehouse_ID)) == FALSE)
    if (length(indexes) > 0){
      j = 1
      while (j <= length(indexes)){
        #Iterate through the contracts that match a warehouse in the filtered warehouses
        current <- indexes[j]
        #Check to see if the specified start and end date overlap the with the dates the warehouse is already rented out
        if(as.Date(start_date) <= Contract$End_Date_of_Lease[current] && as.Date(end_date) >= Contract$Start_Date_of_Lease[current]){
          #If there is no space left during the time specified, remove the warehouse from the list
          if (Filtered_Warehouses$Total_Space_Available_for_Rent[i] - Contract$Space_Rented[current] == 0){
            Filtered_Warehouses <- Filtered_Warehouses[-(i),]
          }
        }
        j = j + 1
      }
    }
   i = i + 1
  }
}

#Sort the Warehouse IDs by popularity, which we define as the number of contracts corresponding to the warehouse
query <- paste("SELECT Warehouse_ID FROM Contract WHERE Warehouse_ID IN (",paste(Filtered_Warehouses$Warehouse_ID,collapse=", "),") GROUP BY Warehouse_ID ORDER BY COUNT(Contract_ID), Warehouse_ID")
Filtered_Warehouses2 <- fetch(dbSendQuery(mydb, query))
if (!(length(Filtered_Warehouses2[,1]) < length(Filtered_Warehouses[,1]))){
  #make sure that the warehouses have ten digits (this is like the mysql zerofill)
  Filtered_Warehouses2$Warehouse_ID <- sprintf("%010d", Filtered_Warehouses2$Warehouse_ID)
  Filtered_Warehouses2$Warehouse_ID
}else{
  #make sure that the warehouses have ten digits (this is like the mysql zerofill)
  Filtered_Warehouses$Warehouse_ID <- sprintf("%010d", Filtered_Warehouses$Warehouse_ID)
  Filtered_Warehouses$Warehouse_ID
}


