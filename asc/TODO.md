# TODO: Create Proper Tests for All Entities

## Overview
Replace all existing stub test files with proper PHPUnit tests for entities. Create missing test files for Lanterne, Phase, Processus, StockLanterne, User. Tests should cover:
- Instantiation
- Getters and setters
- Relationships (add/remove for collections)
- __toString method if present
- Any other custom methods

## Existing Test Files to Update (13)
- [x] ArticlesTest.php
- [x] CordeTest.php
- [x] EmplacementTest.php
- [x] FiliereTest.php
- [ ] FlotteurTest.php
- [ ] FlotteurSegmentTest.php
- [ ] FruitDeMerTest.php
- [ ] ParcTest.php
- [ ] SegmentTest.php
- [ ] StockTest.php
- [ ] StockArticleTest.php
- [ ] StockArticleSnTest.php
- [ ] StockCordeTest.php

## Missing Test Files to Create (5)
- [x] LanterneTest.php
- [x] PhaseTest.php
- [x] ProcessusTest.php
- [x] StockLanterneTest.php
- [x] UserTest.php

## Steps
1. Read each entity file to understand properties, methods, and relationships.
2. Update or create the corresponding test file with proper assertions.
3. Run tests to ensure they pass.
4. Mark as completed in this TODO.
