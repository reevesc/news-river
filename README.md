# news-river
A simple implementation of the NewsRiver Stream API in PHP

## Notes
This is a initial implementation of the NewsRiver Stream API to get us up and running. More updates to come as more work is done with the data. 

## Examples
A very basic implementation can be found in the examples directory.  Be sure to read the instructions in sample-config.php.

## TODO
 - Add support for API request limit (max 1 per second)
 - Testing
   - Need to setup mock API response
   - Test Steam::request()
   - Test Request::send()
     - Actually, just plan on re-writing all of the tests on the Request class