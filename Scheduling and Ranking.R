install.packages("RMySQL")
install.packages("XML")
install.packages("httr")
library(RMySQL)
library(XML)
library(httr)

#Start by running the User_Inputs_Creation function to generate the table of user inputs
User_Inputs <- User_Inputs_Creation(600)
mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
#Start filtering!
for (i in 1:length(User_Inputs[,1])){
  #Create a contracts data frame to add all of the contracts to
  dbDisconnect(mydb)
  mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
  Contract <- fetch(dbSendQuery(mydb, "SELECT * FROM Contract"))
  
  #Get all of the warehouses and their average ratings from the database
  dbDisconnect(mydb)
  mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
  All_Warehouses <- fetch(dbSendQuery(mydb,("SELECT W.Warehouse_ID, AVG(C.Average_Warehouse_Rating) FROM Warehouse W, Contract C WHERE W.Warehouse_ID = C.Warehouse_ID")))
  
  #Get all of the owners and their average average ratings from the database
  dbDisconnect(mydb)
  mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
  All_Owners <- fetch(dbSendQuery(mydb,("SELECT O.User_ID, AVG(C.Average_Warehouse_Rating) FROM Owner O, Contract C WHERE O.User_ID = C.Owner_ID")))
  #Filter the warehouses first by zip code because every user specifies a zip code
  dbDisconnect(mydb)
  mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
  query <- paste0("SELECT * FROM Warehouse W, Listing L WHERE W.Warehouse_ID = L.Warehouse_ID AND W.ZIP_Code = ", User_Inputs$ZIP_Code[i], "")
  Filtered_Warehouses <- fetch(dbSendQuery(mydb, query))
  
  #Create ratings data frames because each party in the contract should be rated
  Warehouse_Rating <- data.frame(matrix(ncol = 3))
  colnames(Warehouse_Rating) <- c("Contract_ID", "Cleanliness", "Safety_and_Repair")
  Owner_Rating <- data.frame(matrix(ncol = 4))
  colnames(Owner_Rating) <- c("Contract_ID", "Courtesy", "Adherence_To_Contract", "Timeliness")
  Lessee_Rating <- data.frame(matrix(ncol = 4))
  colnames(Lessee_Rating) <- c("Contract_ID", "Courtesy", "Adherence_To_Contract", "Timeliness")
  
  dbDisconnect(mydb)
  mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
  #Next, filter by types of storage
  #Logic behind intersect1: we use this variable in the case of a user wanting multiple storage types. For each storage type, if the previous storage types are also selected, then the program will find the common warehouses among all of the generated lists so that the warehouses in the final list have all of the types of storage specified by the user
  intersect1 <- 0
  if (is.na(User_Inputs$Pallet_Racking[i]) == FALSE && length(Filtered_Warehouses[,1]) > 0){
    #If the user wants pallet racking, select the warehouses that have pallet racking and that are in the filtered warehouse table
    if(User_Inputs$Pallet_Racking[i] == 1){
      query1 <- paste("SELECT W.Warehouse_ID FROM Type_Of_Storage T, Warehouse W WHERE W.Warehouse_ID = T.Warehouse_ID AND T.Type_Of_Storage = 'Pallet Racking' AND W.Warehouse_ID IN (",paste(Filtered_Warehouses$Warehouse_ID,collapse=", "),")")
      Filtered_Pal <- fetch(dbSendQuery(mydb,query1))
      intersect1 <- Filtered_Pal$Warehouse_ID
    }
    dbDisconnect(mydb)
    mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
    if(User_Inputs$Shelving[i] == 1){
      query2 <- paste("SELECT W.Warehouse_ID FROM Type_Of_Storage T, Warehouse W WHERE W.Warehouse_ID = T.Warehouse_ID AND T.Type_Of_Storage = 'Shelving' AND W.Warehouse_ID IN (",paste(Filtered_Warehouses$Warehouse_ID,collapse=", "),") GROUP BY W.Warehouse_ID")
      Filtered_Shel <- fetch(dbSendQuery(mydb,query2))
      if(intersect1 != 0 && length(intersect1) > 0){
        intersect1 <- intersect(intersect1,Filtered_Shel$Warehouse_ID)
      }
      else{
        intersect1 <- Filtered_Shel$Warehouse_ID
      }
    }
    dbDisconnect(mydb)
    mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
    if(User_Inputs$Mobile_Shelving[i] == 1){
      query3 <- paste("SELECT W.Warehouse_ID FROM Type_Of_Storage T, Warehouse W WHERE W.Warehouse_ID = T.Warehouse_ID AND T.Type_Of_Storage = 'Mobile Shelving' AND W.Warehouse_ID IN (",paste(Filtered_Warehouses$Warehouse_ID,collapse=", "),") GROUP BY W.Warehouse_ID")
      Filtered_Mob <- fetch(dbSendQuery(mydb,query3))
      if(intersect1 != 0 && length(intersect1) > 0){
        intersect1 <- intersect(intersect1,Filtered_Mob$Warehouse_ID)
      }
      else{
        intersect1 <- Filtered_Mob$Warehouse_ID
      }
    }
    dbDisconnect(mydb)
    mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
    if(User_Inputs$Multi_Tier_Racking[i] == 1){
      query4 <- paste("SELECT W.Warehouse_ID FROM Type_Of_Storage T, Warehouse W WHERE W.Warehouse_ID = T.Warehouse_ID AND T.Type_Of_Storage = 'Multi-tier Racking' AND W.Warehouse_ID IN (",paste(Filtered_Warehouses$Warehouse_ID,collapse=", "),") GROUP BY W.Warehouse_ID")
      Filtered_Mult <- fetch(dbSendQuery(mydb,query4))
      if(intersect1 != 0 && length(intersect1) > 0){
        intersect1 <- intersect(intersect1,Filtered_Mult$Warehouse_ID)
      }
      else{
        intersect1 <- Filtered_Mult$Warehouse_ID
      }
    }
    dbDisconnect(mydb)
    mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
    if(User_Inputs$Mezzanine_Flooring[i] == 1){
      query5 <- paste("SELECT W.Warehouse_ID FROM Type_Of_Storage T, Warehouse W WHERE W.Warehouse_ID = T.Warehouse_ID AND T.Type_Of_Storage = 'Mezzanine Flooring' AND W.Warehouse_ID IN (",paste(Filtered_Warehouses$Warehouse_ID,collapse=", "),") GROUP BY W.Warehouse_ID")
      Filtered_Mezz <- fetch(dbSendQuery(mydb,query5))
      if(intersect1 != 0 && length(intersect1) > 0){
        intersect1 <- intersect(intersect1,Filtered_Mezz$Warehouse_ID)
      }
      else{
        intersect1 <- Filtered_Mezz$Warehouse_ID
      }
    }
  }
  
  #If there are warehouses that match the storage requirements, get all of the information on those warehouses.
  dbDisconnect(mydb)
  mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
  if (intersect1 != 0 && length(intersect1) > 0){
    query <- paste("SELECT * FROM Warehouse W, Listing L WHERE W.Warehouse_ID = L.Warehouse_ID AND W.Warehouse_ID IN (",paste(intersect1,collapse=", "),")")
    Filtered_Warehouses <- fetch(dbSendQuery(mydb,query))
  }else{ #Otherwise, empty out the filtered warehouses dataframe
    for (d in 1:length(Filtered_Warehouses)){
      Filtered_Warehouses[-(d),]
    }
  }
  
  #If the user specifies price bounds, filter only the warehouses that fall within those bounds
  dbDisconnect(mydb)
  mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
  if (is.na(User_Inputs[i,12]) == FALSE && length(Filtered_Warehouses[,1]) > 0){
    query <- paste0("SELECT * FROM Warehouse W, Listing L WHERE W.Warehouse_ID = L.Warehouse_ID AND W.Warehouse_ID IN (",paste(Filtered_Warehouses$Warehouse_ID,collapse=", "),") AND L.Listed_Rental_Price <= ", User_Inputs$Higher_Rental_Price[i], " AND L.Listed_Rental_Price >= ", User_Inputs$Lower_Rental_Price[i], " GROUP BY W.Warehouse_ID")
    Filtered_Warehouses <- fetch(dbSendQuery(mydb, query))
  }
  
  #If the user wants to specify a date range, filter the warehouses based on that
  #If there are no contracts created yet, we do not need to consider overlaps in dates
  if (is.na(User_Inputs[i,2]) == FALSE && length(Contract[,1]) > 0 && length(Filtered_Warehouses[,1]) > 0){
    
    #How many warehouses do we have in consideration
    warehouseLength <- length(Filtered_Warehouses[,1])
    c <- 1
    while (c <= warehouseLength){
      #If there is a contract/contracts that correspond to the warehouse i, store the indexes of those warehouses in the contracts table
      indexes <- which(is.na(which(Filtered_Warehouses$Warehouse_ID[c] %in% Contract$Warehouse_ID)) == FALSE)
      #If this case exists
      if (length(indexes) > 0){
        j = 1
        while (j <= length(indexes)){
          current <- indexes[j]
          #Go through each of the contracts corresponding to the warehouse in question and check if there is an overlap in start date and end date
          if(as.Date(User_Inputs$Start_Date[i]) <= Contract$End_Date_of_Lease[current] && as.Date(User_Inputs$End_Date[i]) >= Contract$Start_Date_of_Lease[current]){
            #If there is no space left in the warehouse during the time requested, automatically remove the warehouse from the list
            if (Filtered_Warehouses$Total_Space_Available_for_Rent[c] - Contract$Space_Rented[current] == 0){
              Filtered_Warehouses <- Filtered_Warehouses[-(c),]
            }
            #If there is space left,
            else{
              #Store this value
              Space_Left <- Filtered_Warehouses$Total_Space_Available_for_Rent[c] - Contract$Space_Rented[current]
              #Replace the space value in the filtered warehouse table with the space left for later calculations
              Filtered_Warehouses$Total_Space_Available_for_Rent[c] <- Space_Left
              #If the user wants the entire warehouse and it is not available, remove the warehouse
              if (is.na(User_Inputs$Entire_Warehouse[i]) == FALSE && Space_Left < Filtered_Warehouses$Total_Space_Available_for_Rent[c]){
                Filtered_Warehouses <- Filtered_Warehouses[-(c),]
              }
              #If the user does not want the entire warehouse
              if (is.na(User_Inputs[i,5]) != FALSE && is.na(User_Inputs[i,6]) != FALSE && is.na(User_Inputs$Entire_Warehouse[i]) == FALSE){
                #If the space left is not within the bounds that the user specified, remove the warehouse
                if (User_Inputs[i,5] > Space_Left || User_Inputs[i,6] < Space_Left){
                  Filtered_Warehouses <- Filtered_Warehouses[-(c),]
                }
              }
            }
          }
          j = j + 1
        }
      }
      c = c + 1
    }
  }else if (is.na(User_Inputs[i,2]) == FALSE && length(Contract[,1]) == 0 && length(Filtered_Warehouses[,1]) > 0){ #If there are no contracts yet, but the user specifies a date range, we don't have to check for overlapping dates
    if (is.na(User_Inputs[i,5]) != FALSE && is.na(User_Inputs[i,6]) != FALSE){
      #If the space left is not within the bounds that the user specified, remove the warehouse
      warehouseLength <- length(Filtered_Warehouses[,1])
      b <- 1
      while (b <= warehouseLength){
        if (User_Inputs[i,5] > Filtered_Warehouses$Total_Space_Available_for_Rent[b] || User_Inputs[i,6] < Filtered_Warehouses$Total_Space_Available_for_Rent[b]){
          Filtered_Warehouses <- Filtered_Warehouses[-(b),]
        }
        b <- b + 1
      }
    }
  }else if (is.na(User_Inputs[i,2]) == TRUE && length(Contract[,1]) > 0 && length(Filtered_Warehouses[,1]) > 0){ #Get a start date for the user (one that does not overlap with any other date ranges)
    dbDisconnect(mydb)
    mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
    query <- paste0("SELECT Warehouse_ID, max(End_Date_of_Lease) AS max_date FROM Contract WHERE Warehouse_ID IN (",paste(Filtered_Warehouses$Warehouse_ID,collapse=", "),")")
    Potential_Dates <- fetch(dbSendQuery(mydb, query))
    if (is.na(Potential_Dates[1,1]) == FALSE){
      sd <- sample(seq(as.Date(max(Potential_Dates$max_date)), as.Date(max(Potential_Dates$max_date)) + 365, by = "day"), 1)
    }else{
      sd <- sample(seq(as.Date('2029/06/30'), as.Date('2030/12/31'), by = "day"), 1)
    }
    
    num <- sample(30:305, 1)
    ed <- sd + num
    sd <- substr(sd,0,10)
    ed <- substr(ed,0,10)
    User_Inputs$End_Date[i] <- ed
    User_Inputs$Start_Date[i] <- sd
  }else if (is.na(User_Inputs[i,2]) == TRUE && length(Contract[,1]) == 0){ #If there are no dates specified and no contracts to draw from, set the dates randomly
    sd <- sample(seq(as.Date('2029/06/30'), as.Date('2030/12/31'), by = "day"), 1)
    
    num <- sample(30:305, 1)
    ed <- sd + num
    sd <- substr(sd,0,10)
    ed <- substr(ed,0,10)
    User_Inputs$Start_Date[i] <- sd
    User_Inputs$End_Date[i] <- ed
  }
  
  #If the user specifies a minimum year built, filter out the warehouses that are older than the year specified
  if (is.na(User_Inputs[i,15]) == FALSE && length(Filtered_Warehouses[,1]) > 0){ 
    dbDisconnect(mydb)
    mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
    queryY <- paste0("SELECT * FROM Warehouse W, Listing L WHERE W.Warehouse_ID = L.Warehouse_ID AND W.Year_Built >= ", User_Inputs$Year_Built[i], " AND W.Warehouse_ID IN (",paste(Filtered_Warehouses$Warehouse_ID,collapse=", "),")")
    Filtered_Warehouses <- fetch(dbSendQuery(mydb,queryY))
  }
  
  #If the user has minimum rating requirements, filter out the warehouses that are not rated above the requirement
  if (is.na(User_Inputs[i,16]) == FALSE && length(Filtered_Warehouses[,1]) > 0){
    Filtered_Ratings <- All_Warehouses$Warehouse_ID[which(User_Inputs$Lower_Warehouse_Rating[i] <= All_Warehouses$Average_Warehouse_Rating)]
    Filtered_Warehouses <- subset(Filtered_Warehouses, !(is.na(match(Filtered_Warehouses$Warehouse_ID, Filtered_Ratings))))
    Filtered_Ratings <- All_Owners$User_ID[which(User_Inputs$Lower_Owner_Rating[i] <= All_Owners$Average_Owner_Rating)]
    Filtered_Warehouses <- subset(Filtered_Warehouses, !(is.na(match(Filtered_Warehouses$Owner_ID, Filtered_Ratings))))
  }
  
  #Create a blank dataframe for the contracts to be sent to the database
  Contracts <- data.frame(matrix(ncol = 13))
  colnames(Contracts) <- c("Owner_ID", "Lessee_ID", "Warehouse_ID", "Start_Date_of_Lease", "End_Date_of_Lease", "Space_Rented", "Terms", "Agreed_Rental_Price", "Average_Warehouse_Rating", "Average_Owner_Rating", "Average_Lessee_Rating", "Pending_Lessee", "Pending_Owner")
  Warehouse_Length <- length(Filtered_Warehouses[,1])
  contract_index <- 1
  #If more than zero results fit the user-specifications, start sending php the warehouses
  if(Warehouse_Length > 0){
    #If there is only one warehouse, we do not need to implement the ranking algorithm
    if (Warehouse_Length == 1){
      Warehouse_Rating[contract_index,2] <- sample(1:5,1)
      Warehouse_Rating[contract_index,3] <- sample(1:5,1)
      Owner_Rating[contract_index,2] <- sample(1:5,1)
      Owner_Rating[contract_index,3] <- sample(1:5,1)
      Owner_Rating[contract_index,4] <- sample(1:5,1)
      Lessee_Rating[contract_index,2] <- sample(1:5,1)
      Lessee_Rating[contract_index,3] <- sample(1:5,1)
      Lessee_Rating[contract_index,4] <- sample(1:5,1)
      Contracts$Owner_ID[contract_index] <- Filtered_Warehouses$Owner_ID[1]
      Contracts$Lessee_ID[contract_index] <- User_Inputs$Lessee_ID[i]
      Contracts$Warehouse_ID[contract_index] <- Filtered_Warehouses$Warehouse_ID[1]
      Contracts$Start_Date_of_Lease[contract_index] <- User_Inputs$Start_Date[i]
      Contracts$End_Date_of_Lease[contract_index] <- User_Inputs$End_Date[i]
      if (is.na(User_Inputs$Lower_Space_Bound[i]) == FALSE){
        Contracts$Space_Rented[contract_index] <- min(c(Filtered_Warehouses$Total_Space_Available_for_Rent[1],User_Inputs$Higher_Space_Bound[i]))
      }else{
        Contracts$Space_Rented[contract_index] <- Filtered_Warehouses$Total_Space_Available_for_Rent[1]
      }
      Contracts$Terms[contract_index] <- "SECTION 1 DEPOSIT Renter agrees to pay Landlord a security deposit of {amount in dollars}, due upon the signing of this Agreement. Deposit will be refundable, in whole or in part, assuming {details of what conditions apply for a refundable deposit}, when this Agreement expires. SECTION 2 RENT Renter agrees to pay Landlord rent in the amount of {amount in dollars} every month on or by the {date}, until this Agreement expires. Payment method must be {check, money order, wire transfer, etc.}. Payments made more than {number} days late are subject to a {amount in dollars} late fee. If Renter is more than {number} days late	{twice, three times, etc.}, Landlord has the right to find Renter in default of this Agreement, and may retain any deposit in full. SECTION 3 INSURANCE Renter and Landlord each agree to hold an insurance policy on the Property in the amount of {amount in dollars}. Renter's policy must cover {his/her/its} personal items inside the property, while Landlord's policy must cover the physical location itself, as well as any personal property located within. SECTION 4 UTILITIES All utilities, including, but not limited to, water, power, gas, sewage, cable, and telephone, are the responsibility of	{Landlord/Renter}. SECTION 5 ALTERATIONS AND IMPROVEMENTS Renter will be allowed to make alterations and improvements to the Property upon the signing of this Agreement, provided that Landlord has approved the alterations and improvements. All alterations and improvements will be done at Renter's expense, and Renter is required to procure any insurance necessary for the alteration process, as well as for any personal property involved in or created by the process. Renter {shall/shall not} be required to return Property to its original condition upon the expiration of this Agreement. SECTION 6 REPAIRS Any repairs necessary to make Property inhabitable, according to the laws of {State}, by Renter shall be the Landlord's responsibility. Repairs resulting from Renter's use of Property, including any damage incurred during move-in or remodel, shall by the responsibility of the Renter. SECTION 7 SUBLETTING Renter {will/will not} be permitted to sublet the Property.	{If Renter is allowed, add the conditions under which Renter may sublet}. SECTION 8 ILLEGAL ACTIVITY Renter agrees to abide by the laws of {State}, and refrain from conducting any illegal business and/or activity at the Property. Should illegal activity be discovered, Landlord reserves the right to terminate this Agreement and retain any deposit in full. SECTION 9 TAXES Property taxes on the building and/or any land associated with the Property shall be the responsibility of the Landlord. Renter is responsible for any applicable taxes on {his/her/its} personal property, including, but not limited to, fixtures, equipment, goods, etc. SECTION 10 TERMINATION OF AGREEMENT Landlord may terminate this Agreement early for reasons other than those listed in Section 2 and Section 5 if{reasons why Landlord may end the Agreement}. Renter may terminate this Agreement if	{reasons, if any, why Renter may end the Agreement}. SECTION 11 AGREEMENT RENEWAL Renter may renew this Agreement {yearly, every two years, etc.} by providing a request, in writing, to the Landlord at least	{30 days, 60 days, 90 days, etc.} prior to the expiration of the current Agreement. Landlord reserves the right to refuse a renewal, provided he gives Renter {60 days, 90 days, etc.} notice."
      Contracts$Agreed_Rental_Price[contract_index] <- Filtered_Warehouses$Listed_Rental_Price[1]
      Contracts$Average_Warehouse_Rating[contract_index] <- (Warehouse_Rating[contract_index,2] + Warehouse_Rating[contract_index,3])/2
      Contracts$Average_Owner_Rating[contract_index] <- (Owner_Rating[contract_index,2] + Owner_Rating[contract_index,3] + Owner_Rating[contract_index,4])/3
      Contracts$Average_Lessee_Rating[contract_index] <- (Lessee_Rating[contract_index,2] + Lessee_Rating[contract_index,3] + Lessee_Rating[contract_index,4])/3
      Contracts$Pending_Lessee[contract_index] <- "No"
      Contracts$Pending_Owner[contract_index] <- "No"
      
      #Send Contract values to database
      dbDisconnect(mydb)
      mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
      dbWriteTable(mydb, "Contract", Contracts, append = TRUE, row.names = FALSE)
      
      #Get the contract id so we can send the ratings to the rating table
      dbDisconnect(mydb)
      mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
      query <- paste0("SELECT Contract_ID from Contract WHERE Owner_ID = ", Contracts$Owner_ID[contract_index], " AND Lessee_ID = ", Contracts$Lessee_ID[contract_index], " AND Warehouse_ID = ", Contracts$Warehouse_ID[contract_index], " AND Space_Rented = ", Contracts$Space_Rented[contract_index], "")
      Contract_ID <- fetch(dbSendQuery(mydb, query))
      
      #Put the contract id in the ratings tables
      Warehouse_Rating[contract_index,1] <- Contract_ID$Contract_ID[which(Contract_ID$Contract_ID == max(Contract_ID$Contract_ID))]
      Owner_Rating[contract_index,1] <- Contract_ID$Contract_ID[which(Contract_ID$Contract_ID == max(Contract_ID$Contract_ID))]
      Lessee_Rating[contract_index,1] <- Contract_ID$Contract_ID[which(Contract_ID$Contract_ID == max(Contract_ID$Contract_ID))]
      
      #Add ratings to database
      dbDisconnect(mydb)
      mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
      dbWriteTable(mydb, "Warehouse_Rating", Warehouse_Rating, append = TRUE, row.names = FALSE)
      dbDisconnect(mydb)
      mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
      dbWriteTable(mydb, "Owner_Rating", Owner_Rating, append = TRUE, row.names = FALSE)
      dbDisconnect(mydb)
      mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
      dbWriteTable(mydb, "Lessee_Rating", Lessee_Rating, append = TRUE, row.names = FALSE)
    }else{ #If there is more than one warehouse, implement the ranking algorithm
      ranking_values <- c()
      #Iterate through the warehouses, and assign them ranking values
      #If the user did not specify a value for the filter, set the ranking value to 0 so that it does not affect the ranking equation
      #If the user specified a value for the filter, apply the subsequent value in the ranking formula
      for (a in 1:Warehouse_Length){
        if (is.na(User_Inputs$Lower_Rental_Price[i]) == FALSE){
          price_ranking <- 4 * abs(as.numeric(Filtered_Warehouses$Listed_Rental_Price[a]) - as.numeric(User_Inputs$Higher_Space_Bound[i]))
        }else{
          price_ranking <- 0
        }
        if (is.na(User_Inputs$Lower_Space_Bound[i]) == FALSE){
          space_ranking <- 3 * abs(as.numeric(Filtered_Warehouses$Total_Space_Available_for_Rent[a]) - as.numeric(User_Inputs$Lower_Space_Bound[i]))
        }else{
          space_ranking <- 0
        }
        if (is.na(User_Inputs$Lower_Owner_Rating[i]) == FALSE){
          owner_rating_ranking <- 2 * abs(as.numeric(Filtered_Warehouses$Total_Average_Owner_Rating[a]) - as.numeric(User_Inputs$Lower_Owner_Rating[i]))
        }else{
          owner_rating_ranking <- 0
        }
        if (is.na(User_Inputs$Lower_Warehouse_Rating[i]) == FALSE){
          warehouse_rating_ranking <- 2 * abs(as.numeric(Filtered_Warehouses$Total_Average_Warehouse_Rating[a]) - as.numeric(User_Inputs$Lower_Warehouse_Rating[i]))
        }else{
          warehouse_rating_ranking <- 0
        }
        if (is.na(User_Inputs$Year_Built[i]) == FALSE){
          year_built_ranking <- 1 * abs(as.numeric(Filtered_Warehouses$Year_Built[a]) - as.numeric(User_Inputs$Year_Built[i]))
        }else{
          year_built_ranking <- 0
        }
        ranking_values[a] <- price_ranking + space_ranking + owner_rating_ranking + warehouse_rating_ranking + year_built_ranking
      }
      
      #Sort the warehouses from the smallest ranking value to the greatest ranking value
      Filtered_Warehouses$rankings <- ranking_values
      index <- with(Filtered_Warehouses, order(-rankings))
      Filtered_Warehouses <- Filtered_Warehouses[index, ]
      Filtered_Warehouses$Warehouse_ID <- sprintf("%010d", Filtered_Warehouses$Warehouse_ID)
      
      #Generate ratings for contract
      Warehouse_Rating[contract_index,2] <- sample(1:5,1)
      Warehouse_Rating[contract_index,3] <- sample(1:5,1)
      Owner_Rating[contract_index,2] <- sample(1:5,1)
      Owner_Rating[contract_index,3] <- sample(1:5,1)
      Owner_Rating[contract_index,4] <- sample(1:5,1)
      Lessee_Rating[contract_index,2] <- sample(1:5,1)
      Lessee_Rating[contract_index,3] <- sample(1:5,1)
      Lessee_Rating[contract_index,4] <- sample(1:5,1)
      
      #Put values in contract in their respective columns
      Contracts$Owner_ID[contract_index] <- Filtered_Warehouses$Owner_ID[1]
      Contracts$Lessee_ID[contract_index] <- User_Inputs$Lessee_ID[i]
      Contracts$Warehouse_ID[contract_index] <- Filtered_Warehouses$Warehouse_ID[1]
      Contracts$Start_Date_of_Lease[contract_index] <- User_Inputs$Start_Date[i]
      Contracts$End_Date_of_Lease[contract_index] <- User_Inputs$End_Date[i]
      if (is.na(User_Inputs$Lower_Space_Bound[i]) == FALSE){
        Contracts$Space_Rented[contract_index] <- min(c(Filtered_Warehouses$Total_Space_Available_for_Rent[1],User_Inputs$Higher_Space_Bound[i]))
      }else{
        Contracts$Space_Rented[contract_index] <- Filtered_Warehouses$Total_Space_Available_for_Rent[1]
      }
      Contracts$Terms[contract_index] <- "SECTION 1 DEPOSIT Renter agrees to pay Landlord a security deposit of {amount in dollars}, due upon the signing of this Agreement. Deposit will be refundable, in whole or in part, assuming {details of what conditions apply for a refundable deposit}, when this Agreement expires. SECTION 2 RENT Renter agrees to pay Landlord rent in the amount of {amount in dollars} every month on or by the {date}, until this Agreement expires. Payment method must be {check, money order, wire transfer, etc.}. Payments made more than {number} days late are subject to a {amount in dollars} late fee. If Renter is more than {number} days late	{twice, three times, etc.}, Landlord has the right to find Renter in default of this Agreement, and may retain any deposit in full. SECTION 3 INSURANCE Renter and Landlord each agree to hold an insurance policy on the Property in the amount of {amount in dollars}. Renter's policy must cover {his/her/its} personal items inside the property, while Landlord's policy must cover the physical location itself, as well as any personal property located within. SECTION 4 UTILITIES All utilities, including, but not limited to, water, power, gas, sewage, cable, and telephone, are the responsibility of	{Landlord/Renter}. SECTION 5 ALTERATIONS AND IMPROVEMENTS Renter will be allowed to make alterations and improvements to the Property upon the signing of this Agreement, provided that Landlord has approved the alterations and improvements. All alterations and improvements will be done at Renter's expense, and Renter is required to procure any insurance necessary for the alteration process, as well as for any personal property involved in or created by the process. Renter {shall/shall not} be required to return Property to its original condition upon the expiration of this Agreement. SECTION 6 REPAIRS Any repairs necessary to make Property inhabitable, according to the laws of {State}, by Renter shall be the Landlord's responsibility. Repairs resulting from Renter's use of Property, including any damage incurred during move-in or remodel, shall by the responsibility of the Renter. SECTION 7 SUBLETTING Renter {will/will not} be permitted to sublet the Property.	{If Renter is allowed, add the conditions under which Renter may sublet}. SECTION 8 ILLEGAL ACTIVITY Renter agrees to abide by the laws of {State}, and refrain from conducting any illegal business and/or activity at the Property. Should illegal activity be discovered, Landlord reserves the right to terminate this Agreement and retain any deposit in full. SECTION 9 TAXES Property taxes on the building and/or any land associated with the Property shall be the responsibility of the Landlord. Renter is responsible for any applicable taxes on {his/her/its} personal property, including, but not limited to, fixtures, equipment, goods, etc. SECTION 10 TERMINATION OF AGREEMENT Landlord may terminate this Agreement early for reasons other than those listed in Section 2 and Section 5 if{reasons why Landlord may end the Agreement}. Renter may terminate this Agreement if	{reasons, if any, why Renter may end the Agreement}. SECTION 11 AGREEMENT RENEWAL Renter may renew this Agreement {yearly, every two years, etc.} by providing a request, in writing, to the Landlord at least	{30 days, 60 days, 90 days, etc.} prior to the expiration of the current Agreement. Landlord reserves the right to refuse a renewal, provided he gives Renter {60 days, 90 days, etc.} notice."
      Contracts$Agreed_Rental_Price[contract_index] <- Filtered_Warehouses$Listed_Rental_Price[1]
      Contracts$Average_Warehouse_Rating[contract_index] <- (Warehouse_Rating[contract_index,2] + Warehouse_Rating[contract_index,3])/2
      Contracts$Average_Owner_Rating[contract_index] <- (Owner_Rating[contract_index,2] + Owner_Rating[contract_index,3] + Owner_Rating[contract_index,4])/3
      Contracts$Average_Lessee_Rating[contract_index] <- (Lessee_Rating[contract_index,2] + Lessee_Rating[contract_index,3] + Lessee_Rating[contract_index,4])/3
      Contracts$Pending_Lessee[contract_index] <- "No"
      Contracts$Pending_Owner[contract_index] <- "No"
      
      #Send Contract values to database
      dbDisconnect(mydb)
      mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
      dbWriteTable(mydb, "Contract", Contracts, append = TRUE, row.names = FALSE)
      
      #Get the contract id so we can send the ratings to the rating table
      dbDisconnect(mydb)
      mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
      query <- paste0("SELECT Contract_ID from Contract WHERE Owner_ID = ", Contracts$Owner_ID[contract_index], " AND Lessee_ID = ", Contracts$Lessee_ID[contract_index], " AND Warehouse_ID = ", Contracts$Warehouse_ID[contract_index], " AND Space_Rented = ", Contracts$Space_Rented[contract_index], "")
      Contract_ID <- fetch(dbSendQuery(mydb, query))
      
      #Put the contract id in the ratings tables
      Warehouse_Rating[contract_index,1] <- Contract_ID$Contract_ID[which(Contract_ID$Contract_ID == max(Contract_ID$Contract_ID))]
      Owner_Rating[contract_index,1] <- Contract_ID$Contract_ID[which(Contract_ID$Contract_ID == max(Contract_ID$Contract_ID))]
      Lessee_Rating[contract_index,1] <- Contract_ID$Contract_ID[which(Contract_ID$Contract_ID == max(Contract_ID$Contract_ID))]
      
      #Add ratings to database
      dbDisconnect(mydb)
      mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
      dbWriteTable(mydb, "Warehouse_Rating", Warehouse_Rating, append = TRUE, row.names = FALSE)
      dbDisconnect(mydb)
      mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
      dbWriteTable(mydb, "Owner_Rating", Owner_Rating, append = TRUE, row.names = FALSE)
      dbDisconnect(mydb)
      mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
      dbWriteTable(mydb, "Lessee_Rating", Lessee_Rating, append = TRUE, row.names = FALSE)
    }
  }
}





