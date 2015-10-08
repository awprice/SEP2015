# SEP2015

## API Endpoints

### `/api/user`

Method: `GET`
Description: Gets the current users details.
Restricted: `True`

### `/api/advertisement/<id>`

Method: `GET`
Description: Gets an advertisement by id
Restricted: `False`

### `/api/offer/<id>`

Method: `GET`
Description: Gets an offer by id, restricted to only the current user's id
Restricted: `True`

### `/api/offers`

Method: `GET`
Description: Gets all of the current users offers
Restricted: `True`