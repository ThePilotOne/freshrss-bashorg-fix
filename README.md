Bashorg BR Fix
Fixes formatting issues in the Bash.org RSS feed when used with FreshRSS.
What it fixes
Some Bash.org RSS entries contain HTML that is escaped one level too much.
For example:
&amp;lt;nickname&amp;gt;
&amp;lt;br&amp;gt;
instead of
&lt;nickname&gt;
<br>
This extension automatically fixes the content during feed import.
Current fixes:
converts
&amp;lt;
&amp;gt;
to
&lt;
&gt;
converts
&lt;br&gt;
into a real HTML <br> tag
The original RSS feed is not modified. The content is corrected only before it is stored in FreshRSS.

Installation

Copy the extension into
FreshRSS/extensions/xExtension-BashorgBrFix
Enable it in FreshRSS and refresh the Bash.org feed.
Compatibility
FreshRSS 1.28+
PHP 8+
License
MIT
