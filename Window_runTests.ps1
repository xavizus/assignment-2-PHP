
# This file will run all tests in the folder tests if 
# the file have an ending with *Test.php (Notice: it's case sensitive)
[regex]$regex = 'PHP ([0-9]{1,}\.)+[0-9]{1,}'
$toFindIn = php --version
$matches = $regex.Matches($toFindIn)
if($matches.Success -eq "True") {
    php .\tests\phpunit.phar --verbose tests
}
else {
    write-host "You need PHP to be installed to run this test!"
}