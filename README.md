# Wally's Widgets

## The Task

Wally’s Widget Company is a widget wholesaler. They sell widgets in a variety of pack sizes:
* 250 widgets
* 500 widgets
* 1,000 widgets
* 2,000 widgets
* 5,000 widgets

Their customers can order any number of widgets, but they will always be given complete packs.
The company wants to be able to fulfil all orders according to the following rules:
1. Only whole packs can be sent. Packs cannot be broken open.
2. Within the constraints of Rule 1 above, send out no more widgets than necessary to fulfil
the order.
3. Within the constraints of Rules 1 & 2 above, send out as few packs as possible to fulfil each
order.

## The Solution

The app consists of:
* A Vue.js front end with Bulma. This makes REST calls to -
* The PHP backend application. This is built with a Hexagonal-style architecture using using the Slim framework to expose the API endpoints.
* While there is not 100% code coverage, I have used PHP Unit to unit test the core functionality,
* I have also translated the requirements into behavioural tests with gherkin and behat

## Setup

* Clone the project,
* Run `make setup` in the root of the project. This will start the containers and install the composer dependencies,
* Go to http://localhost/ to view the UI.
* You can also test the API directly if you wish, the `docs` directory in the root of the project contains postman exports to test the endpoints.
* You can run all of the tests with `make test`

## Areas for Improvement

* The API key is committed to the repository. This should be moved into a secret store,
* The API authentication is very basic with a static API key. It could be improved using oAuth or similar,
* Errors are not currently being logged anywhere,
* The Vue.js front-end "production" distribution is currently built and committed to the repository. We should really be building that as a step in an automated deployment pipeline,
perhaps using a Continuous Integration server,
* While I have attempted to solve the core problem myself, I imagine that there is a far more optimal mathematical solution to this problem.
Like with many problems in computer science and mathematics (i.e. the travelling salesman problem or the bin packing problem), there are "off-the-shelf"
algorithms to solve them efficiently and elegantly.
* The validation of the input parameters is currently being done in the controller. This should be extracted into the application layer as per
the single responsibility principle. Alternatively we could create a value object which would validate itself.
* Additional validation should be done to ensure that only integers have been passed as an input parameter. Currently we are casting
the input to an integer which may cause unexpected behavior if the user has not provided a whole number.

Giles Lloyd – giles@cableandcode.co.uk
