#!/bin/bash

while read line; do
    if ! echo $line | grep '+----' &> /dev/null ; then
      echo $line | sed -E 's/\s+/ /g' | awk -F '\\s*\\|\\s*' '{ print $0 }' | tr '|' "\n"
    fi
done

