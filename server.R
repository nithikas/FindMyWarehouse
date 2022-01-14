library(shiny)

shinyServer(function(input,output){
  output$warehouseData <- renderTable({
  })
})