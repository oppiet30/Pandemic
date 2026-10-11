# Contributing

Create a branch for your change and open a pull request against `master`.
Explain the problem, the resulting behavior, and what you tested. Keep changes
focused. See [ASW/README.md](ASW/README.md) for translation conventions and
isolated database tests. Keep credentials and personal data outside Git.

## AI-assisted changes

AI assistance is welcome. Review and understand the final diff, check its
correctness, and run relevant tests. Describe AI assistance in the pull request
and add a trailer to each commit in which AI generated or substantially changed
code or documentation:

```text
Assisted-by: AGENT_NAME:MODEL_VERSION
```

Use the actual tool and model shown for that work. For example, a commit created
with Codex using GPT-6.1 Sol can include:

```text
Assisted-by: Codex:gpt-6.1-sol
```

State any testing limitations in the PR. AI attribution does not replace the
contributor's review or responsibility for the submitted changes.
