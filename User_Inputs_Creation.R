User_Inputs_Creation <- function(Sample_Size){
  
  library(RMySQL)
  mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
  #Strings containing the category of the filter (i.e. because if a user inputs a start date, they will have to input an end date)
  #Zip code is not included because the user will always have to pick a zip code
  Filter_Broad_Strings <- c("Dates","Space_Range","Types_of_Storage","Price_Range","Year_Built","Ratings")
  #Probabilities that a user will pick one of the broad filter categories based on its importance to the user
  Probability_Filter <- c(0.25,0.16,0.05,0.15,0.015,0.025)
  User_Inputs <- data.frame(matrix(ncol = 17))
  colnames(User_Inputs) = c("Lessee_ID", "Start_Date","End_Date","Entire_Warehouse","Lower_Space_Bound","Higher_Space_Bound","Pallet_Racking","Shelving","Mobile_Shelving","Multi_Tier_Racking","Mezzanine_Flooring","Lower_Rental_Price","Higher_Rental_Price","ZIP_Code","Year_Built","Lower_Warehouse_Rating","Lower_Owner_Rating")
  dbDisconnect(mydb)
  mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
  Potential_Zips = fetch(dbSendQuery(mydb,"SELECT Zip_Code FROM Warehouse"))
  Warehouse_Ratings = rep(5,400)
  Owner_Ratings = rep(5,500)
  
  for (i in 1:Sample_Size){
    x <- sample(1:length(Potential_Zips$Zip_Code),1)
    User_Inputs[i,14] <- Potential_Zips[x,"Zip_Code"]
    #Which filters to pick
    #Randomly selecting how many filters to use
    x = sample(1:6,1) 
    #DESCRIPTION: Uses probabilities to determine which filters to pick
    Occurence_Filter <- sample(Filter_Broad_Strings, size=x, replace=FALSE, prob=Probability_Filter) 
    #DESCRIPTION: Start and End Dates (checking if user selected that as a filter)
    if(!(is.na(match(Filter_Broad_Strings[1],Occurence_Filter))) == TRUE){
      #DESCRIPTION: Randomly selects a start date and then takes only (substring) the year/month/day of the date format
      sd <- sample(seq(as.Date('2022/01/01'), as.Date('2030/12/31'), by = "day"), 1)
      #DESCRIPTION: Randomly generates a number of days (between one month and ten months) and adds it on to start date to get the end date
      num <- sample(30:305, 1)
      ed <- sd + num
      sd <- substr(sd,0,10)
      ed <- substr(ed,0,10)
      User_Inputs[i,2] <- sd
      User_Inputs[i,3] <- ed
      
    }
    #DESCRIPTION: Space Lower and Higher Bounds/Entire Warehouse (checking if user selected that as a filter)
    if(!(is.na(match(Filter_Broad_Strings[2],Occurence_Filter))) == TRUE){
      #DESCRIPTION: Randomly selecting whether or not the user wants the entire warehouse
      ew <- sample(c(0,1),1)
      User_Inputs[i,4] <- ew
      #DESCRIPTION: Randomly picking a value from 1 to the max warehouse space we have in the database
      Space_Available = sample(1:1104320, 1)
      #DESCRIPTION: We randomly select a lower bound and upper bound such that the lower bound < upper bound < space available
      hsb = sample(1:Space_Available, 1)
      lsb = sample(1:hsb, 1)
      User_Inputs[i,6] <- hsb
      User_Inputs[i,5] <- lsb
    }
    #DESCRIPTION: Types of Storage (checking if user selected that as a filter)
    if(!(is.na(match(Filter_Broad_Strings[3],Occurence_Filter))) == TRUE){
      #DESCRIPTION: Getting a random value between 0 and 1 and assigning it to each of the storage types
      pr = sample(c(0,1),1)
      s = sample(c(0,1),1)
      ms = sample(c(0,1),1)
      mtr = sample(c(0,1),1)
      mf = sample(c(0,1),1)
      User_Inputs[i,7] <- pr
      User_Inputs[i,8] <- s
      User_Inputs[i,9] <- ms
      User_Inputs[i,10] <- mtr
      User_Inputs[i,11] <- mf
    }
    if(!(is.na(match(Filter_Broad_Strings[4],Occurence_Filter))) == TRUE){
      #DESCRIPTION: Getting a random value between the lowest price in our data and the highest price in our data
      phb <- sample(seq(from = 0.04, to = 3.79, by = 0.01),1)
      plb <- sample(seq(from = 0.04, to = phb, by = 0.01), 1)
      User_Inputs[i,13] <- phb
      User_Inputs[i,12] <- plb
    }
    if(!(is.na(match(Filter_Broad_Strings[5],Occurence_Filter))) == TRUE){
      yb <- sample(1871:2019,1)
      User_Inputs[i,15] <- yb
    }
    if(!(is.na(match(Filter_Broad_Strings[6],Occurence_Filter))) == TRUE){
      lbwr <- sample(1:5,1)
      lbor <- sample(1:5,1)
      User_Inputs[i,16] <- lbwr
      User_Inputs[i,17] <- lbor
    }
  }
  dbDisconnect(mydb)
  mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
  Lessee <- fetch(dbSendQuery(mydb,"SELECT User_ID FROM Lessee"))
  dbDisconnect(mydb)
  mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
  query <- paste("SELECT User_ID FROM Lessee WHERE User_ID > ", Lessee$User_ID[500], "")
  Lessee2 <- fetch(dbSendQuery(mydb,query))
  Lessee3 <- c(Lessee$User_ID, Lessee2$User_ID)
  x <- sample(1:length(Lessee3), Sample_Size)
  User_Inputs$Lessee_ID <- Lessee3[x]
  dbDisconnect(mydb)
  return(User_Inputs)
}