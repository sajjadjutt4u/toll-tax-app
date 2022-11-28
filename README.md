
# toll-tax-app


## curl call for data entry:

<code>
curl --location --request POST 'http://toll-tax-app.test/api/entry' \
--header 'Accept: application/json' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6IjlSZis5VFZyOUNsaEE3a0swQ05mcnc9PSIsInZhbHVlIjoiTzEzWXFWbzVXcXJNS2M0SkNaeGFVaDdnNFNPbXJLcFgyYTZ1VnhhcGZ4Uk9UQ281aUhxY3BXWnV4eldPWlgrSWQ3d3V0MER0WWROZWR4Z3JsSXVPZWNCMUUrYnJPQklUQnRjWVA0M2ZlcmRUZWVVMUtvd0VMUnppZ1EwRjZXbCsiLCJtYWMiOiJiNTA5NzhhMzdkY2UyOGU4NjliMWVjMGE0ZGQzOTAzMWJhYzI2MjM2ODNiNjM2YmM4NGMwNDA4ZjkwYjQ4ZjExIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlNncS9vRC9xUFgxNzZTaFRWS0lLRGc9PSIsInZhbHVlIjoiczgzWmZvazJpMmdrV0NSNXVLSFlqRWw2YjBvWFYwWTNXc0ZheTZoeWtXUjNHVUxCMEJkOG5FSFJ6MHhycGxzd05sbk5TOXNIVjVLZGdOSVJjcDRXTlZwaVpMVTRuRGZsWlhmaERJTlovOVpiVkZsMUQydVVlNlZEZVRzZHFtUlQiLCJtYWMiOiJjN2UzNDE0ZDBkNTI0Y2MzMDI1NzU4ODQ0YWIyODExZjgyODVlNDk4Yjg4NjAyYjBlODIyZjBjN2MyNzcwMzU5IiwidGFnIjoiIn0%3D' \
--form 'number_plate="LXM-777"' \
--form 'entry_interchange="Zero point"' \
--form 'entry_date_time="2022-01-23 12:44:55"'
</code>


## curl call for getting calculated tax

<code>
curl --location --request POST 'http://toll-tax-app.test/api/calculate-tax' \
--header 'Accept: application/json' \
--form 'number_plate="LXM-777"' \
--form 'exit_interchange="Ph4 Interchange"' \
--form 'exit_date_time="2022-11-28 12:54:55"'
</code>
