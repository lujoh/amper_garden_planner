# Amper Garden Planner

## Live Website

[View the live website here](https://amper-garden-planner.000webhostapp.com/care.php)

## About

This garden planner is a project that I am made for one of my classes. Users will be able to select the plants that they want information on and then they can read information about them on different pages. I am still in the process of adding more plants to the pages. Feel free to suggest a plant you want to see! So far they are mainly the plants that I am personally growing in my garden.
Pages are:
* Location planner
* Planting guide & calendar
* Watering guide
* Plant Care
* Harvest Guide

## New Additions

It is not possible to calculate the frost dates and generate a planting calendar by entering a US Zip code instead of entering the frost dates directly. This feature will use information from OpenStreetMap via the Nominatim API and NOAA via the Climate Data Online API v2 (view Sources below) in order to calculate the nearest weather station for a given zip code and get the relevant frost dates. The dates used here are the dates of 50% probability of 32 $^\circ$ F occurring for the last time in the spring or the first time in the fall. For some zip codes where frost data may not be available or areas outside of the US, there is still the option of entering frost dates directly. The planting calendar is geared towards regions where the planting season is dictated by frost, and is not applicable elsewhere.

### Sources and Tools

* Anthony Arguez, Imke Durre, Scott Applequist, Mike Squires, Russell Vose, Xungang Yin, and Rocky Bilotta (2010). NOAA's U.S. Climate Normals (1981-2010). [Annual elements/values]. NOAA National Centers for Environmental Information. [DOI:10.7289/V5PN93JP](https://www.ncei.noaa.gov/metadata/geoportal/rest/metadata/item/gov.noaa.ncdc:C00821/html)
* [NOAA Climate Data Online API v2](https://www.ncdc.noaa.gov/cdo-web/webservices/v2#gettingStarted)
* [OpenStreetMap](https://www.openstreetmap.org/copyright) Contributors
* [Nominatim](https://nominatim.org/)




## Reasoning

When I started getting into gardening I spent a lot of time looking at information about different plants on various websites. The websites I found had the information I needed, but the way they were organized, they usually had all available information for a single plant on one page. This meant that while I was gardening I would have to access a bunch of different pages to get the same type of information for each of the plants I was planting and on each I would have to scroll down to get to the piece of information that was relevant to what I was doing at that moment. This was inconvenient, especially since I was usually trying to quickly look something up on my phone while I was outside in the garden with bad lighting and poor internet.

I decided for my page I wanted to organize the pages based on what stage in the garden lifecycle I would be in. The location planner is useful before I start my garden so I can plan out what will go where and which plants will go well together. The planting guide and calendar is useful when I am starting to plant things and I want to know when I can get started and what to do once I am ready to plant. The watering guide and plant care guide are both pages that I would check out multiple times throughout the plant lifecycle whenever I run into different questions. The harvest guide gets accessed at the end of the season when I am getting ready to harvest the plants.

The other thing I wanted to do for my page is to give the information about all relevant plants on one page so that I wouldn't have to look through a bunch of different pages to find what I needed. In order to do this, without having a bunch of irrelevant plants displayed on the page, I made an area on the top of the page where users can select which plants they want to see. The plant selection gets stored in a cookie, since a person is likely to be interested in the same plants throughout a single season. The plant selection area can be hidden when it isn't in use, so that it doesn't take up too much space.

## Background

I made this class for my Intermediate Interactive Design class as part of the Informatics program. One of the main focuses for me during this project was using MySQL to store all of the information about the plants and to use it to populate the page content. This was my first website using SQL so I wanted to make it a major part of the website. Since the class ended I have been making additions and changes to the website such as the functionality to calculate frost dates by zip code.
