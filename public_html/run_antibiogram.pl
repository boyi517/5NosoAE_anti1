#!/usr/bin/perl

my $folder = $ARGV[0];
my $address = $ARGV[1];

##### Taxonomic assignments #####
#system("1.Taxonomic-Assignments.pl -i ./temp/$folder/contigFile.fa -d /home/chieh/antibiogram_platform/databases/silva/silva_db -o ./temp/$folder/1.taxAssign -p 12");

system("1.Taxonomic-Assignments.pl -i ./temp/$folder/contigFile.fa -d /home/chieh/antibiogram_platform/databases/silva/silva_db_all -o ./temp/$folder/1.taxAssign -p 12");

open(OUT, ">temp/$folder/taxAssign_ok");
close(OUT);
################################


##### Antibiogram generation and comparison #####
system("3.Antibiogram-Comparison.pl -i ./temp/$folder/contigFile.fa -o ./temp/$folder/3.abProfilesCmp -p 12");

open(OUT, ">temp/$folder/abProfilesCmp_ok");
close(OUT);
################################


$shortNameSP{"Acinetobacter_baumannii"} = "AB";
$shortNameSP{"Enterococcus_faecium"} = "EF";
$shortNameSP{"Klebsiella_pneumoniae"} = "KP";
$shortNameSP{"Pseudomonas_aeruginosa"} = "PA";
$shortNameSP{"Staphylococcus_aureus"} = "SA";

my @tax_list = `cat ./temp/$folder/1.taxAssign/taxAssign.result`;
my @temp = split(/\t/, $tax_list[0]);
my @tmp = split(/_/, $temp[0]);
my $SPname = $tmp[0]."_".$tmp[1];
my $organism = $shortNameSP{$SPname};

if($organism eq "AB" || $organism eq "EF" || $organism eq "KP" || $organism eq "PA" || $organism eq "SA") {
##### cgMLST profiling #####
system("4.cgMLST-Profiler.pl -i ./temp/$folder/contigFile.fa -d /home/chieh/antibiogram_platform/databases/cgMLST_db -h ./temp/$folder/3.abProfilesCmp/hits_table.tsv -b $organism -o ./temp/$folder/4.cgProfiles -p 12");

open(OUT, ">temp/$folder/cgProfiles_ok");
close(OUT);
################################


##### Dendrogram Plotting #####
system("5.Dendro-Plotter_NJ.pl -i ./temp/$folder/4.cgProfiles -o ./temp/$folder/5.DendroPlot");

open(OUT, ">temp/$folder/DendroPlot_ok");
close(OUT);
################################
}

open(OUT, ">temp/$folder/complete_ok");
close(OUT);

##### send Mail #####

if(length($address) != 0 && $address ne "none") {
	system("perl sendmail.pl $folder $address");
}

#####################


