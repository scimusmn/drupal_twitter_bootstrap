#!/bin/sh

# Get all of the vim plugin submodules
git pull && git submodule init && git submodule update && git submodule status

