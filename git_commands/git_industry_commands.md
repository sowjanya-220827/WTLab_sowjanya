**1. Git Configuration Commands**

**1. git config --global user.name**
Command Name: git config --global user.name
Syntax: git config --global user.name "Your Name"
Purpose: Sets the global username for Git. This name appears as the author name in all commits.
Example: git config --global user.name "sowjanya_220827"

**2. git config --global user.email**
Command Name: git config --global user.email
Syntax: git config --global user.email "your-email@example.com"
Purpose: Sets the global email address associated with Git commits.
Example: git config --global user.email "n220827@rguktn.ac.in"

**3. git config --list**
Command Name: git config --list
Syntax: git config --list
Purpose: Displays all the current Git configuration settings including username, email, and other Git settings.
Example: git config --list

**4. git config --unset**
Command Name: git config --unset
Syntax: git config --unset user.name
Purpose: Removes a specific configuration value from Git settings.
Example: git config --unset user.name

<img width="752" height="650" alt="step1" src="https://github.com/user-attachments/assets/f393c809-d806-4343-833e-7591e7dcebbd" />

**2. Repository Setup Commands**
**1. git init**

Command Name: git init
Syntax: git init
Purpose: Initializes a new Git repository in the current directory. It creates a .git folder to track project changes.
Example: git init

**2. git clone**

Command Name: git clone
Syntax: git clone <repository_url>
Purpose: Copies an existing remote repository from GitHub (or other platforms) to your local system.
Example: git clone https://github.com/user/sample-project.git

**3. git clone --branch**
Command Name: git clone --branch
Syntax: git clone --branch <branch_name> <repository_url>
Purpose: Clones a specific branch from a repository instead of the default branch.
Example: git clone --branch develop https://github.com/user/sample-project.git

**4. git clone --depth**
Command Name: git clone --depth
Syntax: git clone --depth <number> <repository_url>
Purpose: Performs a shallow clone by downloading only the latest commits, reducing clone time and size.
Example: git clone --depth 1 https://github.com/user/sample-project.git

<img width="1096" height="490" alt="Screenshot 2026-03-28 223249" src="https://github.com/user-attachments/assets/e6cfe44a-0435-4d58-a4f0-f8b796d976fb" />


# 3. Repository Status & Inspection

 **1. git status**
Command Name: git status  
Syntax:git status
Purpose:
Displays the current state of the working directory and staging area.
Example:
git status

**2. git log**
Command Name: git log
Syntax:git log
Purpose:Shows detailed commit history.
Example:
git log

**3. git log --oneline**
Command Name: git log --oneline
Syntax:git log --oneline
Purpose:Displays commit history in a single-line format.
Example:git log --oneline

**4. git log --graph**

Command Name: git log --graph
Syntax:

git log --graph --oneline --all

Purpose:
Shows commit history in a graphical (branch) format.

Example:

git log --graph --oneline --all
5. git show

Command Name: git show
Syntax:

git show <commit-id>

Purpose:
Displays detailed information about a specific commit.

Example:

git show a1b2c3d
6. git diff

Command Name: git diff
Syntax:

git diff

Purpose:
Shows changes between working directory and staging area.

Example:

git diff
7. git diff --staged

Command Name: git diff --staged
Syntax:

git diff --staged

Purpose:
Shows changes between staged files and last commit.

Example:

git diff --staged
8. git blame

Command Name: git blame
Syntax:

git blame <file-name>

Purpose:
Shows who modified each line of a file.

Example:

git blame README.md
9. git reflog

Command Name: git reflog
Syntax:

git reflog

Purpose:
Shows history of HEAD changes.

Example:

git reflog
10. git shortlog

Command Name: git shortlog
Syntax:

git shortlog

Purpose:
Summarizes commits grouped by author.

Example:git shortlog

<img width="707" height="642" alt="Screenshot 2026-03-29 093544" src="https://github.com/user-attachments/assets/968485a9-8aa0-4c12-be5f-82035e054fd0" />


 **4. File Tracking Commands**

**1. git add**
Command Name:git add

Syntax:git add <file-name>

Purpose:
Adds a specific file to the staging area.

Example:

git add file1.txt
2. git add .

Command Name: git add .

Syntax:

git add .

Purpose:
Adds all modified and new files in the current directory to the staging area.

Example:

git add .
3. git add -p

Command Name: git add -p

Syntax:

git add -p

Purpose:
Allows staging changes interactively (part by part).

Example:

git add -p
4. git restore

Command Name: git restore

Syntax:

git restore <file-name>

Purpose:
Restores a file to its last committed state (discards changes).

Example:

git restore file1.txt
5. git restore --staged

Command Name: git restore --staged

Syntax:

git restore --staged <file-name>

Purpose:
Unstages a file (removes it from staging area).

Example:

git restore --staged file1.txt
6. git rm

Command Name: git rm

Syntax:

git rm <file-name>

Purpose:
Removes a file from the working directory and staging area.

Example:

git rm file1.txt
7. git mv

Command Name: git mv

Syntax:
git mv <old-name> <new-name>

Purpose:
Renames or moves a file.

Example:

git mv file1.txt file2.txt


<img width="597" height="324" alt="Screenshot 2026-03-29 094645" src="https://github.com/user-attachments/assets/15f283fa-503b-4b40-9709-eff93d6527bf" />

 **5. Commit Commands**

 **1. git commit**

Command Name:git commit

Syntax:
git commit

Purpose:
Records changes from the staging area into the repository. Opens a text editor to write the commit message.

Example:

git commit
2. git commit -m

Command Name: git commit -m

Syntax:

git commit -m "commit message"

Purpose:
Commits changes with a message directly from the command line.

Example:

git commit -m "Added login feature"
3. git commit --amend

Command Name: git commit --amend

Syntax:

git commit --amend

Purpose:
Modifies the most recent commit (can change message or add missed changes).

Example:

git commit --amend -m "Updated login feature"
4. git commit --no-edit

Command Name: git commit --no-edit

Syntax:

git commit --amend --no-edit

Purpose:
Amends the last commit without changing its commit message.

Example:

git commit --amend --no-edit

<img width="752" height="88" alt="Screenshot 2026-03-29 095121" src="https://github.com/user-attachments/assets/d78349d6-dfe6-437b-96bb-5c93b9fc04d8" />

**6. Branch Management Commands**

 **1. git branch**

Command Name:git branch

Syntax:
git branch

Purpose:
Lists all local branches in the repository.

Example:

git branch
2. git branch -a

Command Name: git branch -a

Syntax:

git branch -a

Purpose:
Lists all local and remote branches.

Example:

git branch -a
3. git branch -d

Command Name: git branch -d

Syntax:

git branch -d <branch-name>

Purpose:
Deletes a branch safely (only if it is already merged).

Example:

git branch -d feature
4. git branch -D

Command Name: git branch -D

Syntax:

git branch -D <branch-name>

Purpose:
Force deletes a branch (even if not merged).

Example:

git branch -D feature
5. git checkout

Command Name: git checkout

Syntax:

git checkout <branch-name>

Purpose:
Switches to an existing branch.

Example:

git checkout main
6. git checkout -b

Command Name: git checkout -b

Syntax:

git checkout -b <branch-name>

Purpose:
Creates a new branch and switches to it.

Example:

git checkout -b feature
7. git switch

Command Name: git switch

Syntax:

git switch <branch-name>

Purpose:
Switches to an existing branch (modern alternative to checkout).

Example:

git switch main
8. git switch -c

Command Name: git switch -c

Syntax:

git switch -c <branch-name>

Purpose:
Creates a new branch and switches to it (modern alternative).

Example:

git switch -c feature

<img width="1026" height="347" alt="Screenshot 2026-03-29 095555" src="https://github.com/user-attachments/assets/aba5f4ac-caeb-4760-ae82-81fd201f38d2" />
