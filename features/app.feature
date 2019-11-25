@app

Feature: Basic application behaviour

    Background: Lumen application is initialized
        Given initialized application

    Scenario: App should return its basic info when base url was requested
        When "GET" request is sent to "/" route
        And response should exist
        And response should have "200" status
        And response should have "0" errors
        And response should contain:
            | key            |
            | body           |
            | body.app       |
            | body.version   |
            | body.framework |
            | errors         |

    Scenario: App should return Not Found error when non existing route was requested
        When "GET" request is sent to "/non-existing-route" route
        Then response should exist
        And response should have "404" status
        And response should have "1" errors
        And response should contain:
            | key    |
            | errors |
        And response should have error messages:
            | message          |
            | Route not found. |

    Scenario: App should return Method Not Allowed error when route with not allowed method was requested
        When "POST" request is sent to "/" route
        Then response should exist
        And response should have "405" status
        And response should have "1" errors
        And response should contain:
            | key    |
            | errors |
        And response should have error messages:
            | message             |
            | Method not allowed. |
