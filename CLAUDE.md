# Claude Instructions — Ticket to Impact Website

## Git Workflow

After **every change**, automatically:

1. **Stage all modified files:**
   ```bash
   git add -A
   ```

2. **Commit with a short, descriptive message** reflecting what changed:
   ```bash
   git commit -m "<short description of change>"
   ```

3. **Push to the main branch immediately:**
   ```bash
   git push origin main
   ```

### Rules

- **Never ask for confirmation** before staging, committing, or pushing.
- The only exception is a **merge conflict** — in that case, stop and report the conflict to the user before proceeding.
- Commit messages should be concise and descriptive (e.g. `update hero text on homepage`, `fix mobile nav styling`, `add new service card`).
- Always push to `origin main` unless the user explicitly says otherwise.
