# Page Counters

**This is a lower quality project**

Page counters with customisable font and colour, rendered as images. When the image is loaded, the page count increases. There is no IP or fraud detection :)

Created around April 2013.

## DB Setup

	insert into page_counters (Name, Description, Counter, FontFile, Red, Green, Blue)
	values
	('Wedding','Ste and Helen wedding counter', 1, "KGTwoisBetterThanOne.ttf", 85, 119, 119)

 * Don't initailise them with a Counter of 0 for some reason.
 * Font must be found in `/fonts` directory
 * Configure `db.php` with connection details

## Usage

(From the hosted directory)

 *	Load a counter in page: (img src) `/?n=counter_name`
	E.g. for `/host/counters`: `/host/counters?n=Wedding`

 *	Create a counter: `/new.htm`
	Or use API: POST Name, Description, Font, R, G, and B to `/create.php`

## Troubleshooting

If the images fail or contain errors, try `/?n=counter_name&debug=true` to see the raw data. You must fix any PHP error messages which appear in or before the PNG data.