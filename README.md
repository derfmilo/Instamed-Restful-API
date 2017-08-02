# Instamed-Restful-API
Instamed RESTful API that handles CORS. Fixes Issues that can arise from Android and IOS apps as well as locally ran software.

* [Guidelines](#guidelines)
* [Pragmatic REST](#pragmatic-rest)
* [RESTful URLs](#restful-urls)
* [HTTP Verbs](#http-verbs)
* [Responses](#responses)
* [Error handling](#error-handling)
* [Versions](#versions)
* [Record limits](#record-limits)
* [Request & Response Examples](#request--response-examples)


## Pragmatic REST

These guidelines aim to support a truly RESTful API. Here are a few exceptions:
* Put the version number of the API in the URL (see examples below). Don’t accept any requests that do not specify a version number.

    * https://medical.jimnio.com/api/v1/instamed
    * https://medical.jimnio.com/api/v1/officeally

## RESTful URLs

### General guidelines for RESTful URLs
* A URL identifies a resource.
* URLs should include nouns, not verbs.
* Use plural nouns only for consistency (no singular nouns).
* Use HTTP verbs (GET, POST, PUT, DELETE) to operate on the collections and elements.
* You shouldn’t need to go deeper than resource/identifier/resource.
* Put the version number at the base of your URL, for example https://example.com/v1/path/to/resource.
* URL v. header:
    * If it changes the logic you write to handle the response, put it in the URL.
    * If it doesn’t change the logic for each response, like OAuth info, put it in the header.
* Specify optional fields in a comma separated list.
* Formats should be in the form of api/v1/instamed/{username,password,return_url,apiKey,gateKeeper,requestEDI}

### Good URL examples
* List of Claims:
    * GET https://www.medical.jimnio.com/api/v1/instamed?
* Filtering is a query:
    * GET https://medical.jimnio.com/api/v1/instamed?apiKey=$apiKeyHere&password=$passwordHere&gatekeeper=$gateKeeperHere&username=$usernameHere&requestEDI=ISA*00*++++++++++*00*++++++++++*ZZ*10009++++++++++*ZZ*INSTAMED+++++++*060316*1152*U*00401*030019750*1*P*%3a~GS*HR*10009*INSTAMED*20060316*1152*15434*X*004010X093A1~ST*276*030019750~BHT*0010*13**20060316~HL*1**20*1~NM1*PR*2*AETNA*****PI*60054~HL*2*1*21*1~NM1*41*2*PRADIP+V+KANANI+MD*****FI*123456789~HL*3*2*19*1~NM1*1P*2*PRADIP+V+KANANI+MD*****FI*123456789~HL*4*3*22*0~DMG*D8*19460827*F~NM1*QC*1*SMITH*SUZY****MI*123456789~TRN*1*0~AMT*T3*180.00~DTP*232*RD8*20030909-20030909~SE*15*030019750~GE*1*15434~IEA*1*030019750~

### Bad URL examples
* Non-plural noun:
    * https://medical.jimnio.com/instamed
    * https://medical.jimnio.com/instamed/1234
  

## HTTP Verbs

HTTP verbs, or methods, should be used in compliance with their definitions under the [HTTP/1.1](https://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html) standard.
The action taken on the representation will be contextual to the media type being worked on and its current state. Here's an example of how HTTP verbs map to create, read, update, delete operations in a particular context:

| HTTP METHOD | POST            | GET       | PUT         | DELETE |
| ----------- | --------------- | --------- | ----------- | ------ |
| CRUD OP     | CREATE          | READ      | UPDATE      | DELETE |
| /instamed   | basic request   | READ      | Bulk Pull   | ------ |
| /officeally | basic request   | READ      | Bulk Pull   | ------ |


## Responses

* No values in keys
* No internal-specific names (e.g. "node" and "taxonomy term")
* Metadata should only contain direct properties of the response set, not properties of the members of the response set

### Good examples

No values in keys:

    "tags": [
      {"password": "instamedpassword", "username": "InstamedUsername"},
      {"password": "instamedpassword", "username": "InstamedUsername"}
    ],




## Request EDI

Request EDI should be in raw 271 form appended direct to the string

	"Example": {
		"ISA*00*++++++++++*00*++++++++++*ZZ*10009++++++++++*ZZ*INSTAMED+++++++*........."
	}

## Error handling

Error responses should include a common HTTP status code, message for the developer, message for the end-user (when appropriate), internal error code (corresponding to some specific internally determined ID), links where developers can find more info. For example:

    {
      "error" : 400,
      "error" : "No API Key Provided",
      "error" : "No username Provided",
      "error" : "No API gatekeeper Provided",
      "error" : "No Password Provided",
    }

Use three simple, common response codes indicating (1) success, (2) failure due to client-side problem, (3) failure due to server-side problem:
* 200 - OK
* 400 - Bad Request
* 500 - Internal Server Error


## Versions

* Never release an API without a version number.
* Versions should be integers, not decimal numbers, prefixed with ‘v’. For example:
    * Good: v1
    * Bad: 
* Maintain APIs at least one version back.


## Record limits

* If no limit is specified, return results with a default limit.
* To get records 51 through 75 do this:
    * https://medical.jimnio.com/instamed?limit=25&offset=50
    * offset=50 means, ‘skip the first 50 records’
    * limit=25 means, ‘return a maximum of 25 records’

Information about record limits and total available count should also be included in the response. Example:

    {
        "metadata": {
            "resultset": {
                "count": 227,
                "offset": 25,
                "limit": 25
            }
        },
        "results": []
    }

## Request & Response Examples

### API Resources

  - [GET /instamed](#get-instamed)
  - [GET /instamed/[id]](#get-instamedid)
 

### GET /instamed Coming in v2 

Example: https://medical.jimnio.com/api/v1/instamed

Response body:

    {
        "metadata": {
            "resultset": {
                "count": 123,
                "offset": 0,
                "limit": 10
            }
        },
        "results": [
         
        ]
    }

### GET /instamed/[username][password][ediRequest][return_url][apiKey][gateKeeper]

Example: https://medical.jimnio.com/api/v1/instamed/[username][password][ediRequest][return_url][apiKey][gateKeeper]

Response body:

    XML 272



#
