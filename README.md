BasicClickTracking
==================

This script is covered under the GNU Public License (GPL) V 3.0. I have included a copy of the license in the event you would like one, or you can access it at http://opensource.org/licenses/GPL-3.0

This is a basic script to track click activity without cookies, to record that click activity, and to redirect the user post-click.

As many of the top log analyzers use flat files, and the logging is exceptionally basic, I opted to avoid using a database. If you're stuck on a database, this is an easy alteration.



##Recent Changes (v. 1.1)
1. Added an additional `/class` directory and `Logger` class, simplifying the logging process.
2. Sanitized the URL parameters.
3. Clarified the SETUP file.