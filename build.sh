#!/bin/bash
echo Running lint...
shopt -s globstar
for file in **/*.php; do
    OUTPUT=`./bin/php7/bin/php -l "$file"`
    [ $? -ne 0 ] && echo -n "$OUTPUT" && exit 1
done
echo Lint done successfully.
echo -e "version\nms\nstop\n" | ./bin/php7/bin/php src/pocketmine/PocketMine.php --no-wizard | grep -v "\[Eventaxhl] Adding "
if ls plugins/Eventaxhl/Eventaxhl*.phar >/dev/null 2>&1; then
    echo Server packaged successfully.
else
    echo No phar created!
    exit 1
fi