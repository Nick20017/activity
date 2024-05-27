# activity

Execute script using "php main.php" command

First there will be prompted to pass participants amount from 1 to 8. It's optional, so if field remains empty, it will get skipped, but if there is some value, it will be checked for proper input. If value is not an integer or outside the range, it will be prompted again until value ramains empty or is valid number.

Second there is prompt to specify activity type from specified values. It's the same as previous input. If value specified is empty, it's skipped. If value is not in the list, it's prompted again.

Third is an output type with only 2 values available (file and console).

When all the inputs are completed, API request is sent with all the data provided. After response is returned, there is a check for any kind of errors and proper response type.
In case of failure, an error message is displayed in console. Otherwise successful response is being processed.
It's iterating through all the keys and all the key-value pairs are saved in a string variable. All items with empty key or value are skipped, ID same.

# file

If output type is file, first of all it checks if directory "output" exists, if it doesn't, then the folder is created. After that, stream gets open and all the data get saved to "output.txt" file.

# console

If output type is console, all the output is display in console.