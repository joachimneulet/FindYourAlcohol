# Find your Alcohol

Find your alcohol is a website that uses an open source database to reference existing alcohols and cocktails

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

You might want to learn about symfony documentation to correctly understand the framefork used

### Installing

A step by step series of examples that tell you how to get a development env running

This repository misses the /var/ and /vendor/ folders (both symfony utilities folders)
That you will need to download [here](https://symfony.com/download)

```
copy both the folders into the project root
```

It is preferable to create a static route towards a DNS address
for instance

For windows :
```
Open the file C:\Windows\System32\drivers\etc\hosts
```
Create a route (depending on the server you are using)
Example :
```
route add webservices.example.com mask 255.255.255.255 10.11.12.13
```

## Built With

* [Symfony](https://symfony.com/doc/current/index.html#gsc.tab=0) - The web framework used
* [The Cocktail DB](https://www.thecocktaildb.com/api.php) - The database used

## Authors

* **Joachim Neulet** - *Initial work* - [Repositories](https://github.com/joachimneulet)
