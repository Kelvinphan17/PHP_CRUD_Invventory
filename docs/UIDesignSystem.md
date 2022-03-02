# UI Design System

This document describes and sets a guideline that communicates the design of the Subspace inventory system.

Here are the requirements that must be fulfilled for the design and mockups.

Mark | Description <br>
3.0  | [Mock-Ups in HTML / CSS](#mock-ups-in-html--css) <br>
1.0  | [Colour Palette](#colour-palette)<br>
1.0  | [Fonts and Type Scale](#fonts-and-type-scale)<br>
1.0  | [Icons (and other images)](#icons-and-other-images)<br>
1.0  | [Buttons and Form Elements](#buttons-form-elements-and-components)<br>
1.0  | [Components (e.g. popups)](#buttons-form-elements-and-components)<br>
2.0  | Updated README.md to document UI Design System<br>
1.0  | Git usage (commit messages, all students involved)<br>


This document will be going through each requirement one by one. 

## Mock-Ups in HTML / CSS

~~The Mock-Ups made for both the dashboard page and inventory page can be found in [dashboard.html](../dashboard.html)~~ ~~and [inventory.html](../inventory.html)~~ ~~respectively. They are both styled with the same css file in [styles.css](../styles.css)~~.


The Mock Ups no longer exist in HTML, they are now PHP files. To view the code for each page please visit [dashbaord.php](../app/views/dashboard.php) and [inventory.php](app/views/inventory.php). The CSS can be found at [styles.css](../app/views/styles.css). To view these pages in real-time please visit [README.md](../README.md) to view the instructions on how to launch the web app.

Below are screenshots of the view of each page with populated with sample data.

![A picture of the dashboard page](../images/Dashboard.PNG)

![A picture of the inventory page](../images/Inventory.PNG)


## Colour Palette

The colour palette used in the design of Subspace is mostly monochromatic which pivots around the main colour, ![](https://via.placeholder.com/15/236AB9/000000?text=+) `#236AB9`. Within the sidebar the text is just simply white `#fff`, with it's accents being ![](https://via.placeholder.com/15/9dc2ec/000000?text=+) `#9dc2ec`. Within the sidebar interaction, when hovering one of the elements of the menu the colour will change to ![](https://via.placeholder.com/15/6ca4e3/000000?text=+) `#6ca4e3` and when you are active on the specified page, the menu element will change to ![](https://via.placeholder.com/15/3c85da/000000?text=+) `#3c85da`.

The main content view of each of the pages features a background colour of ![](https://via.placeholder.com/15/f0f6fc/000000?text=+) `#f0f6fc`. All the text for the main content view on all pages will be ![](https://via.placeholder.com/15/12345c/000000?text=+) `#12345c`, while border accents are coloured ![](https://via.placeholder.com/15/194981/000000?text=+) `#194981`.

All buttons are styled at opacity 0.8 until hovered, in which they will revert back to full opacity. They are coloured ![](https://via.placeholder.com/15/205ea6/000000?text=+) `#205ea6` with it's inner text colour being ![](https://via.placeholder.com/15/f0f6fc/000000?text=+) `#f0f6fc`.

The colour of the text for the net profit on the dashboard page will change between ![](https://via.placeholder.com/15/12345c/000000?text=+) `#12345c` if there is 0 net profit, ![](https://via.placeholder.com/15/FF0000/000000?text=+) `#FF0000` for a negative net profit and ![](https://via.placeholder.com/15/00FF00/000000?text=+) `#00FF00` for a postive net profit.

## Fonts and Type Scale

The main font used for subspace is https://fonts.google.com/specimen/Poppins. 

The type scale of all the text uses rem units so that the text will be sized relative to the browser font sizing. 

On the sidebar the welcome message is 1.8rem while all menu elements are 1.5rem.

On the dashboard page, the main header is 5rem while all subheaders are 2.5rem with their content being 2.3rem

On the inventory page the main header is 2.5rem while all subsequent text is half the size at 1.25rem. Within the inventory table, all text is sized at 1rem.

## Icons and other images

All icons were imported from https://fontawesome.com/. 

The subspace logo was handmade using adobe illustrator and stored in the images subfolder [here](../images/logo.png).

Below is a screenshot which includes the three icons taken from font awesome (home, inventory and plus) and the subspace logo desgined using adobe illustrator.

![Screenshot of all icons and images used](../images/allicons.PNG)

## Buttons, Form Elements and Components

Buttons were desined to be of colour ![](https://via.placeholder.com/15/205ea6/000000?text=+) `#205ea6` and were set to opacity 0.8 so that when you hover the opacity will revert back to 1. 
In the case of "Add item", as it is an anchor element with an icon embedded into it, it was coloured to be the same colour as text ![](https://via.placeholder.com/15/12345c/000000?text=+) `#12345c` 

These buttons can be seen in the image below.
![Screenshot of all buttons](../images/buttons.PNG)
  
For one of the form elements there is a simple search form with a submit and clear button to search through the inventory table pictured below.
![Screenshot of search form](../images/Form2.PNG)

To access the add item form, we have to click on the "Add item" button which will then reveal a new div that overlays the current page by setting the background to black with an alpha value of 0.5. Normally, this overlay is hidden, but on click of "Add item" the overlay will be disaplayed and will physically be at a higher z-index than the rest of the page thus it will appear on top. This overlay popup includes the add item form, one button and one anchor. The button serves as a submit button for all the inputs while the anchor is simply a close button that will set the overlay back to a none type for display. The full popup view can be seen in the screenshot below.
![Screenshot of the popup overlay](../images/Popup.PNG)

The add item form element is for inputting data about a new item to be added to the inventory list. This overlay includes the required inputs name, size, purchase price and purchase date, all denoted with a red asterisk. From the required attributes, sizing and purchase price are validated to be of the correct format, i.e sizing cannot be 11.7 and purchase price can't include letters. The rest of the form includes optional inputs which include style code, market price and colorway. Below is a screenshot of the form.
![Screenshot of the add item form](../images/Form1.PNG)

