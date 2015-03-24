#Automatized search for correlations in spatial data#

When we have a large amount of data at disposal and are interested in analyzing
it in order to look for correlations between some facts and improve our
knowledge, a common way of proceding is to use the semantic knowledge we
already have to state an hypothesis, and then analyze the data to prove or
disprove it.
Suppose instead to do the opposite: let a machine analyze the data with a large
set of standard operations as first step, and then guessing some hypothesis
based on the many different results we got. By doing research in this way, we
have the advantage that the machine already suggests us a large number of
hypothesis. On one hand most of them have to be discarded because are useless
for our purpouses, but on the other hand some other results could be relevant
and they have been achived by put in relation things that we never thought 
possible to be correlated. We can thus use the *blindness* of a machine as an
impartial start point, and then use our semantic knowledge to find out useful
information. This is particularly true for spatial analisys.  
For example, it is meaningless to know that every plant lives at least within
a distance of 20,000 Km from another one, because we already know that all
plants lives on the Earth, and that Earths circumference is around 40,000 Km.
However, we are definitely more interested in knowing that a particular plant
species lives only in a region, or that some animal species tends to avoid 
entering a particular area. By knowing these latter results, and thank to a
semantic field that computer does not yet own, we could be able to guess why
these facts happens.  
For this reason, instead of guessing first, and then search for a demonstration
of our hypothesis, it would be very useful to have a software that helps us
in finding correlations among spatial data by automatically performing a large
set of calculations, i.e. by applying all kind of known spatial operations that
could let emerge some new knowledge, and then presenting us the results with
some visual aid and let us interpret them afterwards. If we think we find out
some news, we already have some basic proof showing it, and we are free to 
make it more robust by performing more complex and targeted analysis or by
collecting new data.

---

###Operations between spatial elements###

Spatial elements are generally of three kinds:

 1. **Points**: i.e. representing positions
 2. **Lines**: i.e. representing paths
 3. **Polygons**: i.e. representing regions

These three kind of geometric elements can relate to each other in a limited
number of ways, however, if we start considering also some transformations that
we could apply to them, new relationships pops up.   
A powerful transformation is the *buffer* operation: it takes a geometric
element and a range as input, and returns all points that are within that range
from the element. A buffered point becomes a circle, a buffered line becomes a
polygon, and a buffered polygon is just a bigger polygon.   
By extending our analysis with this simple operation, we have at disposal a
number of new ways to search for correlations. Lets now enumerate them,
dividing them by the types of geometric elements that interact.

As it is easy to notice, all the operations listed below produces some kind of
result that is usable in aggregate functions. Because most of these operations
have already been implemented in modern spatial database systems, the only
thing that is missing in order to perform automatic analisys of the data is
implementing these as aggregate functions.

####Point ↔ Point####

 * given two simple elements, calculate the distance between them
 * by buffering a point, check whether the other one is contained in the
   buffer surface
 * by buffering both points, calculate the area they share

![alt text](https://raw.githubusercontent.com/leonixyz/Thesis/master/point2point_distance.png "Distance between points")
![alt text](https://raw.githubusercontent.com/leonixyz/Thesis/master/bufpoint2point_containment.png "Containment of a point into a buffered point")
![alt text](https://raw.githubusercontent.com/leonixyz/Thesis/master/bufpoint2bufpoint_area.png "Area shared by two buffered points")

####Point ↔ Line####

 * given two simple elements, calculate the minimum distance between them
 * given two simple elements, check whether the point lies on the line
 * by buffering the line, check whether the point is contained in the buffer
   surface
 * by buffering the point, calculate the length of the line segment that
   intersects the buffer surface
 * by buffering both of them, calculate the area they share

####Point ↔ Polygon####

 * given a simple point, calculate the distance between them
 * given a simple point, check whether it is contained in the polygon
 * by buffering the point, calculate the area they share

####Line ↔ Line####

 * given two simple elements, calculate the minimum distance between them
 * given two simple elements, check whether they intersect
 * by buffering one of the two lines, calculate the length of the segment of
   the other line that intersects the buffer surface
 * by buffering both lines, calculate the area they share

![alt text](https://raw.githubusercontent.com/leonixyz/Thesis/master/line2line_distance.png "Distance between two lines")
![alt text](https://raw.githubusercontent.com/leonixyz/Thesis/master/bufline2line_segment.png "Intersection between a buffered line and a simple line")
![alt text](https://raw.githubusercontent.com/leonixyz/Thesis/master/bufline2bufline_area.png "Area shared by two buffered lines")

####Line ↔ Polygon####
 
 * given a simple line, calculate the minimum distance between them
 * given a simple line, if it intersects the polygon, calculate the length of
   the intersection
 * by buffering the line, calculate the area the two surfaces share

####Polygon ↔ Polygon####

 * calculate the minimum distance between them
 * calculate the area they share

![alt text](https://raw.githubusercontent.com/leonixyz/Thesis/master/poly2poly_area.png "Area shared by two polygons")

###Ways of performing the calculations involving buffers###

When dealing with buffers, the size of the range used to extend simple elements
is crucial. In addition to that, when buffering points and lines and calculating
the area they share with other polygons, we could be more interested (and
therefore assign more weight for the purpouses of our analysis) to those
surfaces that are nearest to the points/lines. This is trivially represented as
depicting the buffers with a gradient background, and could be accomplished by
performing the sum of all the results of an operation performed over a set of
results that differs in the buffer's size. Another point is how to let the size
vary: linearly, polinomially, exponentially, etc. Every one of these 
possibilities has a different sematinc meaning that can be right or wrong,
depending on the meaning that the geometric elements that are involved have.
