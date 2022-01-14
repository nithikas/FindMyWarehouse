mydb <- dbConnect(MySQL(), user = 'g1090425', password = 'group4332', dbname = 'g1090425', host = 'mydb.ics.purdue.edu')
Warehouses <- fetch(dbSendQuery(mydb, "SELECT * FROM Warehouse"))

library(shiny)

fluidPage(
  titlePanel("Warehouse Data"),
  mainPanel(
    tableOutput("warehouseData")
  )
)
