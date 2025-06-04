# pjsip-registered-endpoints-show-all
These quick and dirty PHP files will display some basic information 
in a browser tab related to any PJSIP registered endpoints.  In its 
default config, the extension, private IP address, user agent and 
registration expiration will be displayed, though it is easy to 
update this with more of the information exposed by the asterisk CLI 
call used to extract this data.  This can be a useful tool for 
turning up a new PBX, as you can see devices register without needing 
CLI access.  The page will refresh the data every 15 seconds, 
which can be adjusted to your needs.

This is updated version with added option to list all endpoints 
regardless of online status. There is global constant SHOW_ALL that
decides if all or only online endpoint would be visible.

More data is collected about endpoints and aranged in structured array. It
may be handy for other uses too.
