#!/usr/bin/perl

my $folder = $ARGV[0];
my $address = $ARGV[1];

#my $folder = "20221025-DDlK-S0V8-yQjdvXM1";
#my $address = "chieh\@mail.nsysu.edu.tw";


my $message = "Dear User,\n
Your job $folder has finished on our 5NosoAE server.
You may visit the following link to receive the results:
https://nosoae.imst.nsysu.edu.tw/result.php?folder=$folder\n
The results will be kept on the server for three months.\n
For any help and technical assistance please contact chieh\@imst.nsysu.edu.tw\n\n
Yours sincerely,
5NosoAE webservice\n
";

open(OUT, ">./temp/$folder/mail_content.txt");
print OUT ("$message");
close(OUT);


#print ("mailx -r 'ProbioMinDB Server<chieh\@mail.nsysu.edu.tw>' -s 'ProbioMinDB: Job $folder finished' $address < ./temp/$folder/mail_content.txt");

if(!(-z "./temp/$folder/3.abProfilesCmp/hits_table.tsv") ) {
	system("mailx -r '5NosoAE Server<chieh\@imst.nsysu.edu.tw>' -s '5NosoAE: Job $folder finished' $address < ./temp/$folder/mail_content.txt");
}

