[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/Streetlayer/functions?utm_source=RapidAPIGitHub_StreetlayerFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# Streetlayer Package
Streetlayer
* Domain: streetlayer.com
* Credentials: apiKey

## How to get credentials: 
0. Go to [Streetlayer website](https://streetlayer.com) 
1. Log in or create a new account
2. Go to [Dashboard page](https://streetlayer.com/dashboard) to get your API key.

## Streetlayer.validateAddress
Verify the provided address

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Api key obtained from Streetlayer
| address1   | String     | The first part of the address to be validated. Ideally, this should contain street name and housenumber only.
| countryCode| String     | The country value of the address to be validated.
| city       | String     | The city value of the address to be validated.
| address2   | String     | Additional address parts which that be appended to the final address. In order to achieve the highest possible level of validation, flat numbers, building numbers, housenumber details like 'A', names and similar parts should be passed into this request parameter.
| address3   | String     | Additional address parts which that be appended to the final address. In order to achieve the highest possible level of validation, flat numbers, building numbers, housenumber details like 'A', names and similar parts should be passed into this request parameter.
| postalCode | String     | The postal code value of the address to be validated.
| county     | String     | Counties are administrative divisions between localities (in most cases, cities) and regions (in most cases, states).
| region     | String     | Usually the first-level administrative divisions within countries, equivalent to states and provinces in the U.S. and Canada. However, most other countries contain regions as well.

## Streetlayer.getAddressFromCoordinates
Lookup of the nearest addresses based on coordinates.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Api key obtained from Streetlayer
| coordinates | String     | Latitude and longitude of the address coma separated

## Streetlayer.autocompleteAddress
Verify the provided address

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Api key obtained from Streetlayer
| text       | String     | The address to be autocompleted in freeform text.
| countryCode| String     | The country in which the API should search for the given address.
| postalCode | String     | Specifying this parameter will restrict autocomplete suggestions to the postal code provided.

## Streetlayer.validateAddressByText
Verify the provided address

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Api key obtained from Streetlayer
| text       | String     | The address to be validated in freeform text.
| countryCode| String     | The country in which the API should search for the given address.

