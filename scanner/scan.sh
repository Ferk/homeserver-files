#!/bin/bash

# Script for saving a scan capture into a png file.
#
# Receives the resolution as a parameter
#

FNAME="scanimage_$(date +%Y-%m-%d_%H:%M:%S)"

DEVICE="hpaio:/usb/Deskjet_1050_J410_series?serial=CN0CT3D2GZ05HW"

if [[ $1 != "" ]]
then
    OPTS=" --resolution=$@"
fi


if scanimage -d "$DEVICE" $OPTS > "${FNAME}.pnm" 2> error.log
then
    convert "${FNAME}.pnm" -crop 0x0+20+5 -fuzz 15% -trim "${FNAME}.png"
    #convert "${FNAME}.pnm" "${FNAME}.png"
    echo "$FNAME.png"
    rm "${FNAME}.pnm"
    exit 0
fi

rm "${FNAME}.pnm"

echo "Error.gif"

exit 1

