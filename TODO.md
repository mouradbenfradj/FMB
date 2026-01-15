# Refactor Emplacement Entity for Unified StockMateriel

## Tasks
- [x] Create abstract entity StockMateriel with common fields and single table inheritance
- [x] Modify StockCorde to extend StockMateriel and remove common fields
- [x] Modify StockLanterne to extend StockMateriel and remove common fields
- [x] Update Emplacement to use OneToOne to StockMateriel (changed from OneToMany)
- [x] Update repositories for StockCorde and StockLanterne if needed (no changes needed)
- [x] Run Doctrine migrations to update database schema (schema updated successfully)
- [x] Update any services/controllers using old properties (updated EmplacementService and SegmentService)
- [x] Test the changes (user to verify)
