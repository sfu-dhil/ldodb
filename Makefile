# Silence output slightly
# .SILENT:

DB := dhil_ldodb
PROJECT := ldodb

include etc/Makefile.legacy

## Local make file
# Override any of the options above by copying them to makefile.local
-include Makefile.local

## -- No targets yet
