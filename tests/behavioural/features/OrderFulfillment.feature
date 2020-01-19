Feature: Ordering Widgets
  In order to fulfill an order with whole packs
  As a user
  The platform must calculate the smallest number of packs of the smallest size possible to fulfill the order.

Scenario Outline: Ordering a Specific Number of Widgets
  Given the pack sizes are 250, 500, 1000, 2000 and 5000
  When I order <ordersize> widgets
  Then I should be allocated <packtotal> packs

  Examples:
    | ordersize | number_of_250 | number_of_500 | number_of_1k | number_of_2k | number_of_5k |
    | 1         | 1             | 0             | 0            | 0            | 0            |
    | 250       | 1             | 0             | 0            | 0            | 0            |
    | 251       | 0             | 1             | 0            | 0            | 0            |
    | 501       | 1             | 1             | 0            | 0            | 0            |
    | 12001     | 1             | 0             | 0            | 1            | 2            |
