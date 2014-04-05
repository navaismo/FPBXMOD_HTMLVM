FreePBX Module HTMLVM
==============

This is a module for send Voicemail Notifications in HTML format for FreePBX >= 2.10

##Features:##

* Create a HTML Template
* Can Add Images.
* Normal Asterisk VM Variables.
* Simple usage.


##Installation:##

1. Download an tar the code:

2. Go to module Admin and upload the tarball:

3. Go to Unsupported Modules and Install it.:

4.- Go to *Settings* --> *Voicemail Admin*

5.- Select the *Settings* tab

6.- Set  *emailbody*  with:
    `${VM_NAME}|${VM_MAILBOX}|${VM_DUR}|${VM_CALLERID}|${VM_DATE}`

7.- Set  *mailcmd* wth:
    `/etc/asterisk/sendvm.php`




by navaismo@gmail.com
