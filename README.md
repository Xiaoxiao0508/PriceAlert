# Introduction
This project is built on  a PHP framework Symfony 5.1,
it's console app that monitor price drop for a given product (Currently only support Woolies)

## Installation

Clone this project to local directory, run this command to install all dependencies  
`composer install`  

## Run
Run the command  
`bin/console app:price-alert --url=xxx --threshold=xxx`  
or `php bin/console app:price-alert --url=xxx --threshold=xxx` in Windows 
For example, if you wanna receive a price alert when the price of Quilton Toilet Tissue 3 Ply White 180 Sheets 24 pack is below $13  
Run command  
`bin/console app:price-alert --url=https://www.woolworths.com.au/shop/productdetails/851925/quilton-toilet-tissue-3-ply-white-180-sheets --threshold=13`

## Todo
* Register command as a cronjob
* Send email notification when price dropped below the target price (Done)
* Save price, date, etc into database and visualize the data
* support more website