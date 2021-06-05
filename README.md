# Conversional Challenge (Invoice Service)

My demo for interview with Conversional. This app contains a dockerized web app which designed to easily install and configured on any machine.

## Installation Requirements
* Shell Access
* Docker
* Docker Compose
* Git
* Make
* CURL

## Docker Services
* NGINX Reverse Proxy
* PHP FPM
* MySQL Database

## Installation Guide:
```
cd ~
git clone git@github.com:zeina1i/conversional-challenge.git
cd conversional-challenge
cp .env.example .env
cp .env.test.example .env.test
make setup
```
Now app should be alive on [http://localhost:8090](http://localhost:8090)

## DataModel
<p align="center"><img src="./conversioanl-data-model.png"></p>

## How To Use App:
Issue these sets of command inside your terminal:
### Create Invoice
```
curl --location --request POST 'localhost:8090/customer/1/invoice' \
--header 'Content-Type: application/json' \
--data-raw '{
    "start_date" : "2021-01-01",
    "end_date": "2021-02-01"
}'
```

### Get Invoice
```
curl --location --request GET 'localhost:8090/customer/1/invoice/1'
```

## Commands
In order to run commands easily you can use make command. This will help you to easily interact with containers or app.
<p align="center"><img src="./commands-list.png"></p>

## Run Tests
```
make phpunit
```