#!/usr/bin/perl

my $folder = $ARGV[0];
my $address = $ARGV[1];

use Mail::Sendmail 0.75; # doesn't work with v. 0.74!

%mail = (
         from => '5NosoAE Server<chieh@mail.nsysu.edu.tw>',
         to => $address,
         subject => $folder,
        );

$message1 = "The 5NosoAE server received a request for a job from your e-mail address. 
Your job has been completed and the results can be received at the following web address:\n
https://nosoae.imst.nsysu.edu.tw/result.php?folder=$folder\n\n
Job ID: $folder\n\n
For any question please contact the support at the address\n
chieh\@mail.nsysu.edu.tw\n
Thank you for using our servers.\n
The 5NosoAE Web Service Team";

$message2 = "The 5NosoAE server received a request for a job from your e-mail address. 
But some error occurred while running the 5NosoAE module.\n
For any question please contact the support at the address\n
chieh\@mail.nsysu.edu.tw\n
Thank you for using our servers.\n
The 5NosoAE Web Service Team";

if(!(-z "./temp/$folder/3.abProfilesCmp/hits_table.tsv") ) {
	$mail{message} = $message1;
} else {
	$mail{message} = $message2;
}

sendmail(%mail) || print "Error: $Mail::Sendmail::error\n";


