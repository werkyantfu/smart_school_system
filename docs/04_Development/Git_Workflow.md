# Git Workflow
## Smart SMS Project

## Branches
- **`main`**: Production code (Stable).
- **`develop`**: Staging code (Testing).
- **`feature/name`**: For new features (e.g., `feature/student-registration`).

## Steps to add a new feature:
1. `git checkout develop`
2. `git checkout -b feature/your-feature`
3. Make changes and commit: `git commit -m "feat: added feature"`
4. Push: `git push origin feature/your-feature`
5. Open a Pull Request on GitHub.