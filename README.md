# Bashorg Fix

A lightweight extension for **FreshRSS** that fixes formatting issues in the Bash.org RSS feed during import.

## Features

The extension automatically fixes common HTML escaping problems found in the башорг.рф RSS feed:

- Converts double-escaped HTML entities:
  - `&amp;lt;nickname&amp;gt;` → `&lt;nickname&gt;`
- Restores line breaks:
  - `&lt;br&gt;` → `<br>`

All modifications are applied **before the entry is stored in the FreshRSS database**.

## Requirements

- FreshRSS 1.28+
- PHP 8.1+

## Installation

Copy the extension into the FreshRSS extensions directory:

```text
FreshRSS/extensions/xExtension-BashorgBrFix
```

Enable the extension from:

```
Settings → Extensions
```

Refresh the Bash.org feed.

## How it works

The extension hooks into FreshRSS using the `entry_before_insert` hook and modifies the raw entry content before it is saved.

It only processes the Bash.org feed and leaves all other feeds untouched.

## Before

```
&amp;lt;xxx&amp;gt;
Hello.&lt;br&gt;Second line.
```

## After

```
<xxx>
Hello.
Second line.
```

## License

MIT License
