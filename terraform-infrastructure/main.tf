# ==========================================
# Provider Configuration
# ==========================================
provider "aws" {
  region = "us-east-1"
}

# ==========================================
# Security Group (Firewall Rules)
# ==========================================
resource "aws_security_group" "production_sg" {
  name        = "sip-snug-production-sg"
  description = "Security group for production environment allowing SSH, HTTP, and HTTPS"

  # Inbound Rules (Ingress)
  ingress {
    description = "Secure Shell Access"
    from_port   = 22
    to_port     = 22
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }

  ingress {
    description = "HTTP Web Traffic"
    from_port   = 80
    to_port     = 80
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }

  ingress {
    description = "HTTPS Secure Web Traffic"
    from_port   = 443
    to_port     = 443
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }

  # --- New Rules-----
  ingress {
    description = "Laravel Direct Access"
    from_port   = 8080
    to_port     = 8080
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }

  ingress {
    description = "phpMyAdmin Direct Access"
    from_port   = 8081
    to_port     = 8081
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }
  # ---------------------------------------------------------

  # Outbound Rules (Egress)
  egress {
    description = "Allow all outbound traffic"
    from_port   = 0
    to_port     = 0
    protocol    = "-1"
    cidr_blocks = ["0.0.0.0/0"]
  }

  tags = {
    Name        = "Production-Security-Group"
    Environment = "Production"
  }
}

# ==========================================
# EC2 Instance Configuration
# ==========================================
resource "aws_instance" "production_server" {
  ami           = "ami-04b70fa74e45c3917"
  instance_type = "t2.micro"

  # IMPORTANT: Replace with your actual AWS Key Pair name
  key_name = "Sip-Snug"

  vpc_security_group_ids = [aws_security_group.production_sg.id]

  root_block_device {
    volume_size = 25
    volume_type = "gp3"
  }

  tags = {
    Name        = "Sip-Snug-Production-Server"
    Environment = "Production"
    ManagedBy   = "Terraform"
  }
}

# ==========================================
# Elastic IP Configuration (Static IP)
# ==========================================
resource "aws_eip" "production_ip" {
  instance = aws_instance.production_server.id
  domain   = "vpc"

  tags = {
    Name        = "Production-Static-IP"
    Environment = "Production"
  }
}

# ==========================================
# Outputs
# ==========================================
output "server_public_ip" {
  description = "The static Elastic IP address of the production server"
  value       = aws_eip.production_ip.public_ip
}
