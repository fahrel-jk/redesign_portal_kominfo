# Graph Report - redesign_portal_kominfo  (2026-09-29)

## Corpus Check
- 107 files · ~183,947 words
- Verdict: corpus is large enough that graph structure adds value.
- Unclassified: 23 file(s) not represented in the graph (top: (none) 17, .css 2, .graphify-bak 1)

## Summary
- 520 nodes · 718 edges · 61 communities (21 shown, 40 thin omitted)
- Extraction: 100% EXTRACTED · 0% INFERRED · 0% AMBIGUOUS · INFERRED: 1 edges (avg confidence: 0.95)
- Token cost: 0 input · 0 output

## Community Hubs (Navigation)
- ServiceCategory
- composer.json
- portal.js
- User
- Illuminate\Database\Seeder
- Illuminate\Database\Schema\Blueprint
- What You Must Do When Invoked
- package.json
- brief_portal_layanan_kominfo_jatim.md
- Portal Layanan Digital Diskominfo Jawa Timur
- graphify reference: extra exports and benchmark
- bootstrap/app.php
- AppServiceProvider
- graphify reference: query, path, explain
- logging.php
- graphify reference: add a URL and watch a folder
- graphify reference: commit hook and native CLAUDE.md integration
- graphify reference: incremental update and cluster-only
- console.php
- artisan
- graphify reference: GitHub clone and cross-repo merge
- graphify reference: transcribe video and audio
- Illuminate\Foundation\Testing\TestCase
- ponytail
- .claude/CLAUDE.md
- extraction-spec.md
- ponytail
- Illuminate\Http\Request
- Gallery

## God Nodes (most connected - your core abstractions)
1. `ServiceCategory` - 34 edges
2. `User` - 33 edges
3. `Service` - 26 edges
4. `Event` - 19 edges
5. `Gallery` - 19 edges
6. `News` - 19 edges
7. `Controller` - 18 edges
8. `What You Must Do When Invoked` - 12 edges
9. `/graphify` - 11 edges
10. `AdminCategoryController` - 10 edges

## Surprising Connections (you probably didn't know these)
- `📄 Catatan Integrasi ke Website Utama` --references--> `Service`  [INFERRED]
  README.md → app/Models/Service.php
- `{closure#1}()` --calls--> `User`  [EXTRACTED]
  tests/Feature/AdminCategoryTest.php → app/Models/User.php
- `{closure#1}()` --calls--> `User`  [EXTRACTED]
  tests/Feature/AdminEventTest.php → app/Models/User.php
- `{closure#1}()` --calls--> `User`  [EXTRACTED]
  tests/Feature/AdminGalleryTest.php → app/Models/User.php
- `{closure#1}()` --calls--> `User`  [EXTRACTED]
  tests/Feature/AdminNewsTest.php → app/Models/User.php

## Import Cycles
- None detected.

## Communities (61 total, 40 thin omitted)

### Community 0 - "ServiceCategory"
Cohesion: 0.07
Nodes (22): AdminCategoryController, AdminServiceController, Service, ServiceCategory, Illuminate\Database\Eloquent\Factories\HasFactory, Illuminate\Database\Eloquent\Model, Illuminate\Database\Eloquent\Relations\BelongsTo, Illuminate\Database\Eloquent\Relations\HasMany (+14 more)

### Community 1 - "composer.json"
Cohesion: 0.04
Nodes (48): pestphp/pest-plugin, php-http/discovery, autoload, autoload-dev, psr-4, psr-4, config, allow-plugins (+40 more)

### Community 2 - "portal.js"
Cohesion: 0.06
Nodes (36): backToTop, categoryList, clearSearch, createServiceCard(), defaultServices, emptyState, eventsData, featuredServices (+28 more)

### Community 3 - "User"
Cohesion: 0.08
Nodes (15): AdminUserController, User, UserFactory, UserSeeder, Illuminate\Database\Eloquent\Factories\Factory, Illuminate\Foundation\Auth\User, Illuminate\Notifications\Notifiable, Illuminate\Support\Facades\Hash (+7 more)

### Community 4 - "Illuminate\Database\Seeder"
Cohesion: 0.12
Nodes (8): DatabaseSeeder, EventSeeder, NewsSeeder, ServiceCategorySeeder, ServiceSeeder, Illuminate\Database\Seeder, Illuminate\Support\Str, Pdo\Mysql

### Community 5 - "Illuminate\Database\Schema\Blueprint"
Cohesion: 0.08
Nodes (16): {closure#1}(), {closure#2}(), {closure#3}(), {closure#1}(), {closure#2}(), {closure#1}(), {closure#2}(), {closure#3}() (+8 more)

### Community 6 - "What You Must Do When Invoked"
Cohesion: 0.07
Nodes (26): For /graphify add and --watch, For /graphify query, For the commit hook and native CLAUDE.md integration, For --update and --cluster-only, /graphify, Honesty Rules, Interpreter guard for subcommands, Part A - Structural extraction for code files (+18 more)

### Community 7 - "package.json"
Cohesion: 0.09
Nodes (19): devDependencies, axios, concurrently, laravel-vite-plugin, tailwindcss, @tailwindcss/vite, vite, private (+11 more)

### Community 8 - "brief_portal_layanan_kominfo_jatim.md"
Cohesion: 0.09
Nodes (21): 10\. Alur Pengembangan yang Disarankan, 11\. Output / Deliverables, 12\. Acceptance Criteria, 13\. Catatan Integrasi ke Website Utama, 14\. Batasan Scope Tahap Awal, 1\. Latar Belakang, 2\. Tujuan, 3.1. Landing / Public Portal (+13 more)

### Community 9 - "Portal Layanan Digital Diskominfo Jawa Timur"
Cohesion: 0.12
Nodes (16): 1. Clone & Install Dependencies, 1. Public Portal (Landing Page), 2. Konfigurasi Environment, 2. Secret Admin CMS (`/admin`), 3. Migrasi Database & Seeding, 4. Kompilasi Aset Frontend & Jalankan Server, 📄 Catatan Integrasi ke Website Utama, 📌 Fitur Utama (+8 more)

### Community 10 - "graphify reference: extra exports and benchmark"
Cohesion: 0.22
Nodes (8): graphify reference: extra exports and benchmark, Step 6b - Wiki (only if --wiki flag), Step 7 - Neo4j export (only if --neo4j or --neo4j-push flag), Step 7a - FalkorDB export (only if --falkordb or --falkordb-push flag), Step 7b - SVG export (only if --svg flag), Step 7c - GraphML export (only if --graphml flag), Step 7d - MCP server (only if --mcp flag), Step 8 - Token reduction benchmark (only if total_words > 5000)

### Community 11 - "bootstrap/app.php"
Cohesion: 0.38
Nodes (5): {closure#1}(), {closure#2}(), Illuminate\Foundation\Application, Illuminate\Foundation\Configuration\Exceptions, Illuminate\Foundation\Configuration\Middleware

### Community 13 - "graphify reference: query, path, explain"
Cohesion: 0.33
Nodes (5): For /graphify explain, For /graphify path, graphify reference: query, path, explain, Step 0 — Constrained query expansion (REQUIRED before traversal), Step 1 — Traversal

### Community 14 - "logging.php"
Cohesion: 0.40
Nodes (4): Monolog\Handler\NullHandler, Monolog\Handler\StreamHandler, Monolog\Handler\SyslogUdpHandler, Monolog\Processor\PsrLogMessageProcessor

### Community 15 - "graphify reference: add a URL and watch a folder"
Cohesion: 0.50
Nodes (3): For /graphify add, For --watch, graphify reference: add a URL and watch a folder

### Community 16 - "graphify reference: commit hook and native CLAUDE.md integration"
Cohesion: 0.50
Nodes (3): For git commit hook, For native CLAUDE.md integration, graphify reference: commit hook and native CLAUDE.md integration

### Community 17 - "graphify reference: incremental update and cluster-only"
Cohesion: 0.50
Nodes (3): For --cluster-only, For --update (incremental re-extraction), graphify reference: incremental update and cluster-only

### Community 24 - "ponytail"
Cohesion: 0.40
Nodes (4): graphify, ponytail, Safety & Integrity:, The Decision Ladder (evaluate before writing code):

### Community 27 - "ponytail"
Cohesion: 0.40
Nodes (4): graphify, ponytail, Safety & Integrity:, The Decision Ladder (evaluate before writing code):

### Community 50 - "Illuminate\Http\Request"
Cohesion: 0.07
Nodes (21): AdminAuthController, AdminDashboardController, AdminEventController, AdminNewsController, Controller, PublicPortalController, Event, News (+13 more)

### Community 51 - "Gallery"
Cohesion: 0.15
Nodes (8): AdminGalleryController, Gallery, GallerySeeder, {closure#1}(), {closure#2}(), {closure#4}(), {closure#5}(), {closure#6}()

## Knowledge Gaps
- **148 isolated node(s):** `$schema`, `name`, `type`, `description`, `keywords` (+143 more)
  These have ≤1 connection - possible missing edges or undocumented components. (Counts symbols only; 263 node(s) total have ≤1 connection when file, concept and rationale nodes are included.)
- **40 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `User` connect `User` to `ServiceCategory`, `Illuminate\Http\Request`, `Gallery`?**
  _High betweenness centrality (0.046) - this node is a cross-community bridge._
- **Why does `Service` connect `ServiceCategory` to `Portal Layanan Digital Diskominfo Jawa Timur`, `Illuminate\Http\Request`, `Illuminate\Database\Seeder`?**
  _High betweenness centrality (0.039) - this node is a cross-community bridge._
- **Why does `ServiceCategory` connect `ServiceCategory` to `Illuminate\Http\Request`, `Illuminate\Database\Seeder`?**
  _High betweenness centrality (0.029) - this node is a cross-community bridge._
- **What connects `$schema`, `name`, `type` to the rest of the system?**
  _148 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `ServiceCategory` be split into smaller, more focused modules?**
  _Cohesion score 0.06821480406386067 - nodes in this community are weakly interconnected._
- **Should `composer.json` be split into smaller, more focused modules?**
  _Cohesion score 0.04081632653061224 - nodes in this community are weakly interconnected._
- **Should `portal.js` be split into smaller, more focused modules?**
  _Cohesion score 0.0627177700348432 - nodes in this community are weakly interconnected._