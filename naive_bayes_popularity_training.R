install.packages("e1071")
#Call Naive Bayes library
library(e1071)
#Set up connection to database
mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
#Fetch the warehouses that currently have contracts, all of their attributes, their prices, and how many contracts they have (correlates with popularity)
Warehouse <- fetch(dbSendQuery(mydb, "SELECT W.Warehouse_ID, W.Owner_ID, W.Street_Address, W.City, W.State, W.Zip_Code, W.Total_Space_Available_for_Rent, W.Year_Built, W.Property_Type, L.Listed_Rental_Price, COUNT(C.Contract_ID) AS Number_of_Contracts FROM Warehouse W, Contract C, Listing L WHERE W.Warehouse_ID = C.Warehouse_ID AND L.Warehouse_ID = W.Warehouse_ID GROUP BY W.Warehouse_ID ORDER BY W.Warehouse_ID"))
#Fetch the number of contracts in the system
Contract_Length <- fetch(dbSendQuery(mydb,"SELECT COUNT(Contract_ID) AS Length FROM Contract"))

#Go through the warehouses and change specific values to factor levels to make calculating the probabilities easier
for (i in 1:length(Warehouse[,1])){
  if (Warehouse$Number_of_Contracts[i] >= ceiling(Contract_Length$Length/length(Warehouse[,1]))){
    Warehouse$Popularity[i] <- "Popular"
  }
  else{
    Warehouse$Popularity[i] <- "Not Popular"
  }
  
  if (Warehouse$Year_Built[i] > 1900 && Warehouse$Year_Built[i] <= 1920){
    Warehouse$Year_Built[i] <- "1900-1920"
  }else if (Warehouse$Year_Built[i] > 1920 && Warehouse$Year_Built[i] <= 1940){
    Warehouse$Year_Built[i] <- "1920-1940"
  }else if (Warehouse$Year_Built[i] > 1940 && Warehouse$Year_Built[i] <= 1960){
    Warehouse$Year_Built[i] <- "1940-1960"
  }else if (Warehouse$Year_Built[i] > 1960 && Warehouse$Year_Built[i] <= 1980){
    Warehouse$Year_Built[i] <- "1960-1980"
  }else if (Warehouse$Year_Built[i] > 1980 && Warehouse$Year_Built[i] <= 2000){
    Warehouse$Year_Built[i] <- "1980-2000"
  }else if (Warehouse$Year_Built[i] > 2000 && Warehouse$Year_Built[i] <= 2020){
    Warehouse$Year_Built[i] <- "2000-2020"
  }else{
    Warehouse$Year_Built[i] <- "Pre-1900s"
  }
  
  if (Warehouse$Total_Space_Available_for_Rent[i] > 0 && Warehouse$Total_Space_Available_for_Rent[i] <= 10000){
    Warehouse$Total_Space_Available_for_Rent[i] <- "Less than 10000"
  }else if (Warehouse$Total_Space_Available_for_Rent[i] > 10000 && Warehouse$Total_Space_Available_for_Rent[i] <= 20000){
    Warehouse$Total_Space_Available_for_Rent[i] <- "10000-20000"
  }else if (Warehouse$Total_Space_Available_for_Rent[i] > 20000 && Warehouse$Total_Space_Available_for_Rent[i] <= 30000){
    Warehouse$Total_Space_Available_for_Rent[i] <- "20000-30000"
  }else if (Warehouse$Total_Space_Available_for_Rent[i] > 30000 && Warehouse$Total_Space_Available_for_Rent[i] <= 40000){
    Warehouse$Total_Space_Available_for_Rent[i] <- "30000-40000"
  }else if (Warehouse$Total_Space_Available_for_Rent[i] > 40000 && Warehouse$Total_Space_Available_for_Rent[i] <= 50000){
    Warehouse$Total_Space_Available_for_Rent[i] <- "40000-50000"
  }else if (Warehouse$Total_Space_Available_for_Rent[i] > 50000 && Warehouse$Total_Space_Available_for_Rent[i] <= 60000){
    Warehouse$Total_Space_Available_for_Rent[i] <- "50000-60000"
  }else if (Warehouse$Total_Space_Available_for_Rent[i] > 60000 && Warehouse$Total_Space_Available_for_Rent[i] <= 70000){
    Warehouse$Total_Space_Available_for_Rent[i] <- "60000-70000"
  }else if (Warehouse$Total_Space_Available_for_Rent[i] > 70000 && Warehouse$Total_Space_Available_for_Rent[i] <= 80000){
    Warehouse$Total_Space_Available_for_Rent[i] <- "70000-80000"
  }else if (Warehouse$Total_Space_Available_for_Rent[i] > 80000 && Warehouse$Total_Space_Available_for_Rent[i] <= 90000){
    Warehouse$Total_Space_Available_for_Rent[i] <- "80000-90000"
  }else if (Warehouse$Total_Space_Available_for_Rent[i] > 90000 && Warehouse$Total_Space_Available_for_Rent[i] <= 100000){
    Warehouse$Total_Space_Available_for_Rent[i] <- "90000-100000"
  }else{
    Warehouse$Total_Space_Available_for_Rent[i] <- "Greater than 100000"
  }
  if (Warehouse$Listed_Rental_Price[i] > 0 && Warehouse$Listed_Rental_Price[i] <= 0.4){
    Warehouse$Listed_Rental_Price[i] <- "Less than $0.40"
  }else if (Warehouse$Listed_Rental_Price[i] > 0.40 && Warehouse$Listed_Rental_Price[i] <= 0.60){
    Warehouse$Listed_Rental_Price[i] <- "$0.40-$0.60"
  }else if (Warehouse$Listed_Rental_Price[i] > 0.60 && Warehouse$Listed_Rental_Price[i] <= 0.80){
    Warehouse$Listed_Rental_Price[i] <- "$0.60-$0.80"
  }else if (Warehouse$Listed_Rental_Price[i] > 0.80 && Warehouse$Listed_Rental_Price[i] <= 1.00){
    Warehouse$Listed_Rental_Price[i] <- "$0.80-$1.00"
  }else if (Warehouse$Listed_Rental_Price[i] > 1.00 && Warehouse$Listed_Rental_Price[i] <= 1.20){
    Warehouse$Listed_Rental_Price[i] <- "$1.00-$1.20"
  }else if (Warehouse$Listed_Rental_Price[i] > 1.20 && Warehouse$Listed_Rental_Price[i] <= 1.40){
    Warehouse$Listed_Rental_Price[i] <- "$1.20-$1.40"
  }else{
    Warehouse$Listed_Rental_Price[i] <- "Greater than $1.40"
  }
}

#Create a new dataframe that only includes the information we want to be used to determine the classifier
Warehouse2 <- Warehouse[,(4:12)]
Warehouse2 <- Warehouse2[,-(6)]
Warehouse2 <- Warehouse2[,-(7)]
Warehouse2 <- Warehouse2[,-(1)]
Warehouse2 <- Warehouse2[,-(2)]

#Change dataframes so that the values within them are factors rather than characters so that the Naive Bayes Classifier will work
Warehouse2$State <- as.factor(Warehouse2$State)
Warehouse2$Total_Space_Available_for_Rent <- as.factor(Warehouse2$Total_Space_Available_for_Rent)
Warehouse2$Year_Built <- as.factor(Warehouse2$Year_Built)
Warehouse2$Listed_Rental_Price <- as.factor(Warehouse2$Listed_Rental_Price)
Warehouse2$Popularity <- as.factor(Warehouse2$Popularity)

#Create the Naive Bayes model from the training data to classify the data as popular or not
Naive_Bayes_Model=naiveBayes(Popularity ~., data=Warehouse2)

#Use the model as a predictor for the training data
NB_Predictions=predict(Naive_Bayes_Model,Warehouse2)

#Create a confusion matrix to see how accurate our model is for classifying the data
table(NB_Predictions,Warehouse2$Popularity)
