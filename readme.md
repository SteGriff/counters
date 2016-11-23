# Page Counters

Page counters with customisable font and colour, rendered as images. When the image is loaded, the page count increases. There is no IP or fraud detection :)

Created around April 2013.

## DB Setup

	insert into page_counters (Name, Description, Counter, FontFile, Red, Green, Blue)
	values
	('Wedding','Ste and Helen wedding counter', 1, "KGTwoisBetterThanOne.ttf", 85, 119, 119)

 * Don't initailise them with a Counter of 0 for some reason.
 * Font must be found in `/fonts` directory

## Usage

/host/counters?n=counter_name
  
/host/counters?n=Wedding