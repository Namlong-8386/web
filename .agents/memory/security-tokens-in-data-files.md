---
name: Storing bearer tokens in JSON data files
description: Project stores user session tokens in plaintext inside source-controlled JSON data files, which is a credential-leak risk.
---

`api/data/users.json` contains plaintext `token` fields for active user sessions, including admin accounts. These tokens are checked by the API on every authenticated request (e.g., `api/user.php`).

**Why this matters:** If the repo or deploy artifacts are exposed, these bearer tokens allow account takeover and session replay. The file is also tracked by git, so leaked tokens remain in history.

**How to apply:** Any security work on authentication or session handling should migrate tokens out of users.json into a non-tracked, server-side store (e.g., sessions table, Redis, or JWT with a server-side secret/rotation). Existing tokens should be invalidated and users forced to re-login after the change.
