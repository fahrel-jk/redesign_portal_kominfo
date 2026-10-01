## graphify

This project has a knowledge graph at graphify-out/ with god nodes, community structure, and cross-file relationships.

Rules:
- For codebase questions, first run `graphify query "<question>"` when graphify-out/graph.json exists. Use `graphify path "<A>" "<B>"` for relationships and `graphify explain "<concept>"` for focused concepts. These return a scoped subgraph, usually much smaller than GRAPH_REPORT.md or raw grep output.
- If graphify-out/wiki/index.md exists, use it for broad navigation instead of raw source browsing.
- Read graphify-out/GRAPH_REPORT.md only for broad architecture review or when query/path/explain do not surface enough context.
- After modifying code, run `graphify update .` to keep the graph current (AST-only, no API cost).

## ponytail

Pragmatic, minimalist coding rules for token efficiency and clean architecture:

### The Decision Ladder (evaluate before writing code):
1. **Does it need to exist?** (YAGNI — skip speculative/unneeded features).
2. **Is it already in the codebase?** (Reuse existing helpers, models, and components).
3. **Can the standard library / framework do it?** (Use built-in Laravel & JS capabilities).
4. **Is there a native platform feature?** (Use native browser & HTML5 standards).
5. **Is there an already installed dependency?** (Reuse existing dependencies).
6. **Can it be a clean, concise implementation?** (Prefer simple, maintainable solutions).
7. **Only then write code:** Write the minimal code that works efficiently.

### Safety & Integrity:
- Never compromise on validation, error handling, security, accessibility, or unit/feature tests.
- Be lazy about unnecessary architectural complexity, but thorough about safety and correctness.

