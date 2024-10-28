#!/usr/bin/perl

# output files
#   ncbi_dataset.zip
#   contigFile.fa
#   contigFile.list

use File::Basename;
my $programName = basename($0);

use FindBin;
my $programPath = $FindBin::Bin;

use Getopt::Long;
my $usage = "
Usage:    $programName -i GenBank_ID -o save_dir

Arguments: -i  Input GenBank assembly accession [String]
           -o  Save directory [String]

Example: Download GenBank assembly GCA_000018445.1
         $programName -i GCA_000018445.1 -o ./temp/folder\n\n\n";


my $genbankID = undef;
my $outPath = undef;

die $usage unless GetOptions(
		'i|GenBank_ID=s'         => \$genbankID,
        'o|save_dir=s'        => \$outPath)
	&& defined $genbankID
	&& defined $outPath
	&& @ARGV == 0;


#die "\nError in opening contig file $inPath\n\n" if(!-e $inPath);
#die "$!" if(!-e $inPath);

mkdir("$outPath", 0755) || die "$!" if(!-e "$outPath");

system("echo $genbankID > $outPath/contigFile.list");

system("/home/chieh/bin/ncbi-datasets/datasets download genome accession $genbankID --exclude-genomic-cds --exclude-gff3 --exclude-protein --exclude-rna --no-progressbar --filename $outPath/ncbi_dataset.zip");

system("unzip -q $outPath/ncbi_dataset.zip -d $outPath");

system("mv $outPath/ncbi_dataset/data/GCA_*/GCA_*.fna $outPath/contigFile.fa");

system("rm -rf $outPath/ncbi_dataset");


