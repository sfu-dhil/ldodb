ldodb
=====

A Symfony project created on July 11, 2017, 3:25 pm.

bibliographic_terms_search          x too few
binding_feature_search              x too few
contribution_search                 x no use case - join table.
digital_copy_holder_search          x too few
genre_search                        x too few
keyword_search                      y
map_size_search                     x too few
map_type_search                     x too few
organization_search                 y
other_copy_location_search          x no use case - join table.
other_national_edition_search       x no use case - join table.
place_search                        y
plate_type_search                   x too few
referenced_person_search            y
referenced_place_search             x no use case - join stable.
role_search                         x too few (102 so maybe.)
subject_heading_search              y
subject_search                      y
supplemental_place_data_search      x no use case
task_search                         x too few

fulltext searchable fields
==========================

book: title
keyword: keyword
organization: organization_name
people: first_name, last_name
place: place_name
referenced_person: first_name, last_name
subject: subject_name
subjectHeading: subject_heading_name
