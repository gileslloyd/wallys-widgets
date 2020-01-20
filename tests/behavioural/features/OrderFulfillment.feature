Feature: Ordering Widgets
  In order to fulfill an order with whole packs
  As a user
  The platform must calculate the smallest number of packs fulfill the order while minimizing excess widgets.

Scenario Outline: Ordering a Specific Number of Widgets
  Given the pack sizes are 250, 500, 1000, 2000 and 5000
  When I order <ordersize> widgets
  Then I should be allocated <number_of_250> packs of 250
  And I should be allocated <number_of_500> packs of 500
  And I should be allocated <number_of_1k> packs of 1000
  And I should be allocated <number_of_2k> packs of 2000
  And I should be allocated <number_of_5k> packs of 5000

  Examples:
    | ordersize | number_of_250 | number_of_500 | number_of_1k | number_of_2k | number_of_5k |
    | 1         | 1             | 0             | 0            | 0            | 0            |
    | 250       | 1             | 0             | 0            | 0            | 0            |
    | 251       | 0             | 1             | 0            | 0            | 0            |
    | 501       | 1             | 1             | 0            | 0            | 0            |
    | 12001     | 1             | 0             | 0            | 1            | 2            |
