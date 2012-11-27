This simple fieldtype makes it slightly easier to work with dollar amount entry fields, and may be easily modified for other currencies. It accepts some reasonable input formatting...

- $1,500
- 120.00
- $5

...but strips it down and stores integers for easy sorting with template tags. Note that it'll output the stored int value in templates, but that can easily be fixed with [Price Format](http://devot-ee.com/add-ons/price-format) or some quick PHP.

This was created for a client project where we needed to be lenient with input but store values uniformly for entry sorting on the website.