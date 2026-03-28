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

2. Repository Setup Commands
1. git init

Command Name: git init
Syntax: git init
Purpose: Initializes a new Git repository in the current directory. It creates a .git folder to track project changes.
Example: git init

2. git clone

Command Name: git clone
Syntax: git clone <repository_url>
Purpose: Copies an existing remote repository from GitHub (or other platforms) to your local system.
Example: git clone https://github.com/user/sample-project.git

3. git clone --branch

Command Name: git clone --branch
Syntax: git clone --branch <branch_name> <repository_url>
Purpose: Clones a specific branch from a repository instead of the default branch.
Example: git clone --branch develop https://github.com/user/sample-project.git

4. git clone --depth

Command Name: git clone --depth
Syntax: git clone --depth <number> <repository_url>
Purpose: Performs a shallow clone by downloading only the latest commits, reducing clone time and size.
Example: git clone --depth 1 https://github.com/user/sample-project.git

<img width="752" height="650" alt="step1" src="git_commands\git screenshots\Screenshot 2026-03-28 223249.png" />
