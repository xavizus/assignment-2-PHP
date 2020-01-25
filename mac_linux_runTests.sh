# This file will run all tests in the folder tests if 
# the file have an ending with *Test.php (Notice: it's case sensitive)
if [ "$(php --version | grep -Po "PHP ([0-9]{1,}\.)+[0-9]{1,}")" ]; then
        php ./tests/phpunit.phar --verbose tests
else
        echo "You need PHP installed!"
fi
