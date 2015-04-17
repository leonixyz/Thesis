#Thesis#

###Premises###

The goal of this analysis is to make predictions, based on a pre-existent source of plants data, of habitats where some plant species can live. This result could be useful for spotting rare plants, or to easily find a place where they can be planted in order to increase the overall population of the species.

The result will be achieved by using a PostgreSQL database with PostGIS extension and some PHP pages served by an Apache webserver.

Data at our disposal consists in a large amount of records, graphically represented by points, that indicates places in South Tyrol where a large set of different plants have been found. Points are classified by a list of attributes, but only some of them are considered for the purpouses of this analysis. Attributes includes species names, whether or not the position where they have been found is exact, and the positions themselves. The accuracy of the position is due to the fact that many records were imported from biological literature and compared with those collected by the museum's collaborators are geographically more inaccurate. These latter  records have an impact on the way the analysis is performed because they have to be treated a little bit differently.

###Short description of the software that performs the analysis from the users point of view###

 1 An end user can import new data consisting in new map layers. This is done by providing the system with ESRI Shapefiles that are converted to PostGIS SQL code and run against the database. An example for that is data relative the land use, available thanks to the WFS of the Province Bozen.

 2 Once a new layer has been imported, the user is prompted for selecting the attribute(s) that distinct that data. For example, in the case of land use, the land type (forest, rocks, etc.) would be a typical choice. However, it could be the case that the new layer has other relevant properties recorded among its data, like i.e. the ground altitude, or its permeability, or even a time attribute, and all these can be put into the set of distinctive attributes. Whether or not they will be considered in a particular analysis, however, will be a subsequent choice of the end user that possesses the background knowledge and has the freedom to try the best combination in order to achieve his/her goal.

 3 At this stage, given the original (plant) data and the new layers with their distinctive attributes, one can select a subset of plants of interest. Their positions will be checked by a set of rules made by the user and derived from layers and their attributes. As a final result, depending on how the rules matches, a statistic is provided by aid of graphs.

###System's perspective of the analysis###

 1 Whenever a shapefile is uploaded through a PHP page, it is processed by `shp2pgsql` to get an SQL version that will be executed against the database.
 2 The tables created by the import are checked in order to provide to the user a list of attributes that are distinctive for the new data set. The system suggests some choices based on their value types and some other characteristics. When the user marks the attributes as distinctive, for each one of them a new empty column is added to the original plants data table.
 3 The list of all distinctive attributes of all data sets is presented to the user. After he/she selects some of them and eventually set their matching capabilities, these preference will be saved as a new rule.
 4 A page is presented to the user so that he/she can select a set of rules and a source data set (subset of plants). The rules are fired against the source data set and the relative columns are filled with the result values. These values are presented as an analysis.
