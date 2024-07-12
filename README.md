# Task to refactor ugly code

I solved this task, using OOP and structuring files with PSR 4.
For code style, I used rules, that were applicable at my last employment

executable file - `app.php`.

`src` folder contains all separated code. 

`tests` folder contains unit tests for all services, except those which are using external links

However, during testing I discovered that rate retrieving by provided url is failed:
I encountered an error, described below.

```json
{
  "success": false,
  "error": {
    "code": 101,
    "type": "missing_access_key",
    "info": "You have not supplied an API Access Key. [Required format: access_key=YOUR_ACCESS_KEY]"
  }
}
```
