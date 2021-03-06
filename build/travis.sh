#!/bin/bash

PHP_BINARY="bin/php7/bin/php"

while getopts "p:" OPTION 2> /dev/null; do
	case ${OPTION} in
		p)
			PHP_BINARY="$OPTARG"
			;;
	esac
done

./build/lint.sh -p "$PHP_BINARY"	
./build/update.sh

if [ $? -ne 0 ]; then
	echo Lint scan failed!
	exit 1
fi

cp -r ./build/plugins/PocketMine-DevTools plugins
"$PHP_BINARY" ./plugins/PocketMine-DevTools/src/DevTools/ConsoleScript.php --make ./plugins/PocketMine-DevTools --relative ./plugins/PocketMine-DevTools --out ./plugins/DevTools.phar
rm -rf ./plugins/PocketMine-DevTools

echo -e "version\nmakeserver\nstop\n" | "$PHP_BINARY" src/pocketmine/PocketMine.php --no-wizard --disable-ansi --disable-readline --debug.level=2
if ls plugins/DevTools/Eventaxhl*.phar >/dev/null 2>&1; then
    echo Server phar created successfully.
else
    echo No phar created!
    exit 1
fi
