#Spatial analysis in biology#

In spatial analysis, and especially when dealing with life forms, the results
obtained from a computer algorithm have to be semantically selected in order
to become useful.  
For example, it is meaningless to know that every plant lives at least within
a distance of 20,000 Km from another one, because we already know that all
plants lives on the Earth, and that Earths circumference is around 40,000 Km.
Instead, we are generally more interested in knowing that a particular plant
species lives only in a region, or that some animal species tends to avoid 
entering a particular space. By knowing these latter results, and thank to a
semantic field that computer does not yet own, we are able to guess the reasons
for these facts to happen.  
Generally, we are intested only in a subset of all the results that an analysis
can produce, because some are obvious, and others are completely meaningless.
For this reason, it would be very useful to have a software that helps us
in finding correlations between spatial data, by presenting a set of results
obtained by applying all kind of known spatial operations that could let emerge
some new knowledge.

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


####Point ↔ Point####

![alt text](https://github.com/leonixyz/Thesis.git/point2point_distance.png "Distance between points")
![alt text](https://github.com/leonixyz/Thesis.git/bufpoint2point_containment.png "Containment of a point into a buffered point")
![alt text](https://github.com/leonixyz/Thesis.git/bufpoint2bufpoint_area.png "Area shared by two buffered points")

 * given two simple elements, calculate the distance between them
 * by buffering a point, check whether the other one is contained in the
   buffer surface
 * by buffering both points, calculate the area they share

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

![alt text](https://github.com/leonixyz/Thesis.git/line2line_distance.png "Distance between two lines")
![alt text](https://github.com/leonixyz/Thesis.git/bufline2line_segment.png "Intersection between a buffered line and a simple line")
![alt text](https://github.com/leonixyz/Thesis.git/bufline2bufline_area.png "Area shared by two buffered lines")

 * given two simple elements, calculate the minimum distance between them
 * given two simple elements, check whether they intersect
 * by buffering one of the two lines, calculate the length of the segment of
   the other line that intersects the buffer surface
 * by buffering both lines, calculate the area they share

####Line ↔ Polygon####
 
 * given a simple line, calculate the minimum distance between them
 * given a simple line, if it intersects the polygon, calculate the length of
   the intersection
 * by buffering the line, calculate the area the two surfaces share

####Polygon ↔ Polygon####

![alt text](https://github.com/leonixyz/Thesis.git/poly2poly_area.png "Area shared by two polygons")

 * calculate the minimum distance between them
 * calculate the area they share

###Ways of performing the calculations involving buffers###

When dealing with buffers, the size of the range used to extend simple elements
is crucial. In addition to that, when buffering points and lines and calculating
the area they share with other polygons, we could be more interested (and
therefore assign more weight for the purpouses of our analysis) to those
surfaces that are nearest to the points/lines. This is trivially represented as
depicting the buffers with a gradient background, and could be accomplished by
performing an arithmetic mean over the results of the operation over a set of
results that differs by the buffer size.
